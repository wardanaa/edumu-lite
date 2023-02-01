<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\V1\ContentCommentCreateRequest;
use App\Http\Requests\Api\V1\ContentCreateRequest;
use App\Http\Requests\Api\V1\ContentRatingRequest;
use App\Models\Content;
use App\Models\ContentComment;
use App\Models\Customer;
use App\Repositories\Api\V1\ContentCategoryRepository;
use App\Repositories\Api\V1\ContentCommentRepository;
use App\Repositories\Api\V1\ContentRepository;
use Illuminate\Http\Request;

class ContentController extends ApiController {

    /** @var ContentRepository */
    protected $contentRepository;

    /** @var ContentCategoryRepository */
    protected $contentCategoryRepository;

    /** @var ContentCommentRepository */
    protected $contentCommentRepository;

    /**
     * ContentController constructor.
     * @param ContentRepository $contentRepository
     * @param ContentCategoryRepository $contentCategoryRepository
     * @param ContentCommentRepository $contentCommentRepository
     */
    public function __construct(ContentRepository $contentRepository, ContentCategoryRepository $contentCategoryRepository, ContentCommentRepository $contentCommentRepository) {
        $this->contentRepository         = $contentRepository;
        $this->contentCategoryRepository = $contentCategoryRepository;
        $this->contentCommentRepository  = $contentCommentRepository;
    }


    public function content(Request $request) {
        $page  = $request->get('page', 1);
        $query = $request->get('query', "");

        $data = $this->contentRepository->getContentPagination($query);

        $this->total = $data->total();
        if (count($data)) {

            foreach ($data as $content) {
                if (!empty($content->customer_image)) {
                    $content->customer_image = url('storage/' . $content->customer_image);
                }
            }
            $this->status = true;
            $this->data   = ['content' => $data->items()];
        } else {
            $this->text = 'Data tidak ditemukan';
        }


        return $this->api_response();
    }

    public function detail(Request $request) {
        $id = $request->get('id');
        /** @var Content $content */
        $content = Content::find($id);

        if (!$content) {
            return $this->api_response();
        }

        if ($content->type == Content::TYPE_CONTENT){
            /** @var Customer $customer */
            $customer = $content->customer;
            if (!$customer) {
                return $this->api_response();
            }

            $content->customer_image = $customer->picture;
            $content->customer_name  = $customer->name;
            $content->comment_count  = $this->contentCommentRepository->getCountComment($content->id);
            $rating                  = $this->contentRepository->getAvgRate($content->id);
            if (count($rating)) {
                $content->rate = $rating[0]->rate;
            } else {
                $content->rate = '0.0';
            }

            $contentRate = $this->contentRepository->getCustomerRate($customer, $content->id);
            if ($contentRate) {
                $content->customer_rate = $contentRate->rating;
            } else {
                $content->customer_rate = 0;
            }
        }

        if (!empty($content->file)) {
            $content->file_ext = pathinfo($content->file, PATHINFO_EXTENSION);
            $content->file     = basename($content->file);
        }


        $this->status = true;
        $this->data   = ['content' => [$content]];
        return $this->api_response();
    }

    public function create(ContentCreateRequest $request) {
        $this->contentRepository->createData(
            $request->only('reg_id', 'title', 'description', 'type', 'url'),
            $request->file('file')
        );

        $this->status = true;
        $this->text   = "Konten berhasil ditambahkan";
        return $this->api_response();
    }

    public function rating(ContentRatingRequest $request) {

        $this->contentRepository->setRating($request->only(['content_id', 'rating']));
        $this->status = true;
        $this->text   = 'Berhasil menambahkan rating';
        return $this->api_response();
    }

    public function comment(Request $request) {
        $contentId = $request->get('content_id');
        $page      = $request->get('page');

        $comments = $this->contentCommentRepository->getByContentPagination($contentId);

        $this->total = $comments->total();
        if (count($comments)) {
            /**
             * @var int $key
             * @var ContentComment $comment
             */
            foreach ($comments as $key => $comment) {
                $comments[$key]->created_at_text = $comment->created_at->diffForHumans();
                //                dd();
                //                $comments[$key]->created_at = $comment->created_at->diffForHumans();
            }
            $this->status = true;
            $this->data   = ['content_comments' => $comments->items()];
        } else {
            $this->text = 'Belum terdapat komentar';
        }

        return $this->api_response();
    }

    public function commentCreate(ContentCommentCreateRequest $request) {

        $this->contentCommentRepository->createData($request->only(['content_id', 'text']));

        $this->status = true;
        $this->text   = 'Berhasil menambahkan komentar';
        return $this->api_response();
    }

    public function ebook(Request $request) {
        $page       = $request->get('page');
        $query      = $request->get('query');
        $categoryId = $request->get('category_id');
        $categories = $this->contentCategoryRepository->getActive()->toArray();

        $data = $this->contentRepository->getEBookPagination($categoryId, $query);

        $categoryAll = [['id' => 0, 'name' => 'Semua']];
        $categories  = array_merge($categoryAll, $categories);

        $this->total = $data->total();
        if (count($data) > 0 && count($categories) > 0) {
            /**
             * @var integer $key
             * @var Content $content
             */
            foreach ($data as $key => $content) {
                if (!empty($content->file)) {
                    $content->file_ext = pathinfo($content->file, PATHINFO_EXTENSION);
                } else {
                    $content->file_ext = 'URL';
                }
                if (!empty($content->image)) {
                    $content->image = $content->image_location;
                }
                if (!empty($content->short_description)){
                    $content->short_description = $content->short_description . ' Halaman';
                }

            }
            $this->status = true;
            $this->data   = ['content' => $data->items(), 'categories' => $categories];
        } else {
            $this->text = 'Data tidak ditemukan';
        }


        return $this->api_response();
    }

    public function download($filename) {
        return response()->download('storage' . Content::FILE_PATH . '/' . $filename);
    }
}