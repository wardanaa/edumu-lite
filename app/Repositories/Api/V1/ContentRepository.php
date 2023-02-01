<?php


namespace App\Repositories\Api\V1;


use App\Exceptions\ApiGeneralException;
use App\Models\Content;
use App\Models\ContentComment;
use App\Models\ContentRate;
use App\Models\Customer;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class ContentRepository extends BaseRepository {


    /**
     * ContentRepository constructor.
     * @param Content $model
     */
    public function __construct(Content $model) {
        $this->model = $model;
    }

    public function countContentActive() {
        return $this->model
            ->where('type', Content::TYPE_CONTENT)
            ->where('active', 1)
            ->count();
    }

    public function getContentNews() {
        return $this->model
            ->where('active', 1)
            ->where('type', Content::TYPE_NEWS)
            ->orderBy('created_at', 'ASC')
            ->take(4)
            ->get();
    }

    public function getContentNew() {
        return $this->model
            ->where('active', 1)
            ->where('type', Content::TYPE_CONTENT)
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();
    }

    public function getContentPagination($querySearch) {
        return $this->model
            ->select('content.*')
            ->addSelect('customer.image AS customer_image')
            ->addSelect('customer.name AS customer_name')
            ->addSelect(DB::raw('COALESCE(content_comment_count.ct, 0) AS comment_count'))
            ->addSelect(DB::raw('COALESCE(content_rate.rate, 0) AS rate'))
            ->join('customer', 'customer.id', 'content.customer_id')
            ->when(!empty($querySearch), function ($query) use ($querySearch){
                $query->where('content.name', 'LIKE', '%' . $querySearch . '%');
            })
            ->leftJoin(DB::raw("
            (
                SELECT content_comment.content_id,
                COUNT(1) AS ct
                FROM content_comment
                GROUP BY content_comment.content_id
            ) AS content_comment_count"), 'content_comment_count.content_id', 'content.id')
            ->leftJoin(DB::raw("
            (
                SELECT content_rate.content_id,
                ROUND(AVG(content_rate.rating),1) AS rate
                FROM content_rate
                GROUP BY content_rate.content_id
            ) AS content_rate"), 'content_rate.content_id', 'content.id')
            ->where('content.active', 1)
            ->where('content.type', Content::TYPE_CONTENT)
            ->orderBy('content.created_at', 'DESC')
            ->paginate(15);
    }

    public function getEBookPagination($categoryId, $search) {
        return $this->model
            ->select('content.*')
            ->where('content.active', 1)
            ->when(!empty($categoryId), function ($query) use ($categoryId){
                $query->where('content.content_category_id', $categoryId);
            })
            ->when(!empty($query), function ($query) use ($search){
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->where('content.type', Content::TYPE_E_BOOK)
            ->orderBy('content.created_at', 'DESC')
            ->paginate(15);
    }

    public function getAvgRate($contentId) {
        return ContentRate::select(DB::raw('COALESCE(ROUND(AVG(rating),1), 0) AS rate'))
            ->where('content_id', $contentId)
            ->groupBy('content_id')
            ->get();
    }



    public function getCustomerRate(Customer $customer,$contentId){
        if ($customer == null){
            $customer = auth()->user();
        }
        return ContentRate::where('content_id', $contentId)->where('customer_id', $customer->id)->first();
    }

    public function createData(array $data, UploadedFile $file = null) {
        /** @var Customer $customer */
        $customer  = auth()->user();
        $fileImage = "";
        if (isset($data['type']) && $data['type'] == "url") {
            if (empty($data['url'])){
                throw new ApiGeneralException('Url wajib diisi');
            }
        }else{
            if ($file == null) {
                throw new ApiGeneralException('File wajib disertakan');
            }
        }
        if ($file != null) {
            $fileImage = $file->store(Content::FILE_PATH, 'public');
            if (false === $fileImage) {
                throw new ApiGeneralException("Error upload file");
            }
        }
        return DB::transaction(function () use ($customer, $data, $fileImage) {
            if (empty($customer->no_reg)) {
                $customer->no_reg = $data['no_reg'];
                if (!$customer->save()) {
                    throw new ApiGeneralException('Error update no registrasi');
                }
            }
            $content              = new Content();
            $content->customer_id = $customer->id;
            $content->name        = $data['title'];
            $content->description = $data['description'];
            $content->type        = Content::TYPE_CONTENT;
            if (isset($data['type']) && $data['type'] == "url") {
                $content->url = $data['url'];
            } else {
                $content->file = $fileImage;
            }
            if ($content->save()) {
                return $content;
            }

            throw new ApiGeneralException('Error menambahkan konten');
        });
    }

    public function setRating(array $data) {
        /** @var Content $content */
        $content = Content::find($data['content_id']);
        /** @var Customer $customer */
        $customer = auth()->user();
        if (!$content){
            throw new ApiGeneralException('Data konten tidak ditemukan');
        }
        $rating = isset($data['rating']) ? $data['rating'] : 0;
        if ($rating < 1 || $rating > 5){
            throw new ApiGeneralException('Rating tidak sesuai');
        }
        $contentRate = ContentRate::where('content_id', $content->id)->where('customer_id', $customer->id)->first();
        if (!$contentRate){
            $contentRate = new ContentRate();
            $contentRate->content_id = $content->id;
            $contentRate->customer_id = $customer->id;
        }
        $contentRate->rating = $rating;
        if ($contentRate->save()){
            return $contentRate;
        }
        throw new ApiGeneralException('Error menambahkan rating');
    }
}