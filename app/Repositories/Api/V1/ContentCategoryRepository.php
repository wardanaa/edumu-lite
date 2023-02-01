<?php


namespace App\Repositories\Api\V1;


use App\Models\ContentCategory;
use App\Repositories\BaseRepository;

class ContentCategoryRepository extends BaseRepository {

    /**
     * ContentRepository constructor.
     * @param ContentCategory $model
     */
    public function __construct(ContentCategory $model) {
        $this->model = $model;
    }

    public function getActive(){
        return $this->model
            ->select(['id','name'])
            ->where('active', 1)
            ->get();
    }
}