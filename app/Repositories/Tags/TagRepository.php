<?php

namespace App\Repositories\Tags;

use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository
{
    /**
     * Tag model.
     * @var Model
     */
    protected $model;

    /**
     * TagRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }
}
