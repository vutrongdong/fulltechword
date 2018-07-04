<?php

namespace App\Repositories\Blogs;

use App\Repositories\BaseRepository;
use App\Repositories\UploadTrait;

class BlogRepository extends BaseRepository
{
    use UploadTrait;
    /**
     * Blog model.
     * @var Model
     */
    protected $model;

    /**
     * BlogRepository constructor.
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }
}
