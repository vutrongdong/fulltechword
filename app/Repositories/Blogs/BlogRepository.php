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

    /**
     * Store a record
     *
     * @param  array  $data
     * @param  boolean $isBatch
     * @return Model|bool
     */
    public function store(array $data, $isBatch = false)
    {
        $tags = array_get($data, 'tags', []);
        $model = $this->model->create($data);
        if ($tags && count($tags)) {
            $model->tags()->sync(array_pluck($tags, 'id'));
        }
        return $model;
    }

    /**
     * Update a record
     *
     * @param  int $id
     * @param  array $data
     * @return Model|null
     */
    public function update($id, array $data)
    {
        if ($record = $this->getById($id)) {
            $tags = array_get($data, 'tags', []);
            $record->fill($data)->save();
            $record->tags()->sync(array_pluck($tags, 'id'));
            return $record;
        }
        return null;
    }

    /**
     * Delete or destroy record
     *
     * @param  array|int $id
     * @return bool|null
     */
    public function delete($id, $isDestroy = false)
    {
        if ($record = $this->getById($id)) {
            $record->tags()->sync([]);
            return $isDestroy ? $record->forceDelete()
                : $record->delete();
        }
        return null;
    }
}
