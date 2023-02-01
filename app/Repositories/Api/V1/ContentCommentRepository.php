<?php


namespace App\Repositories\Api\V1;


use App\Exceptions\ApiGeneralException;
use App\Models\Content;
use App\Models\ContentComment;
use App\Models\Customer;
use App\Repositories\BaseRepository;

class ContentCommentRepository extends BaseRepository {

    /**
     * ContentRepository constructor.
     * @param ContentComment $model
     */
    public function __construct(ContentComment $model) {
        $this->model = $model;
    }

    public function getCountComment($contentId) {
        return $this->model->where('content_id', $contentId)->count();
    }

    public function getByContentPagination($contentId){
        return $this->model
            ->select('content_comment.*')
            ->addSelect('customer.image AS customer_image')
            ->addSelect('customer.name AS customer_name')
            ->join('customer', 'customer.id', 'content_comment.customer_id')
            ->where('content_comment.content_id', $contentId)
            ->orderBy('content_comment.created_at', 'DESC')
            ->paginate(15);
    }

    public function createData(array $data) {
        /** @var Customer $customer */
        $customer = auth()->user();

        $contentComment = $this->model->create([
            'content_id' => $data['content_id'],
            'customer_id' => $customer->id,
            'text' => $data['text']
        ]);

        if ($contentComment){
            return $contentComment;
        }
        throw new ApiGeneralException('Error menambahkan komentar');
    }
}