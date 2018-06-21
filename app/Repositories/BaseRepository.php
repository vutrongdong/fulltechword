<?php

namespace App\Repositories;

abstract class BaseRepository implements EntityInterface
{
    /**
     * Eloquent model
     *
     * @var Model
     */
    protected $model;

    /**
     * Get all records
     *
     * @return Illuminate\Support\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get records with filter by params
     *
     * @param  array   $params
     * @param  integer $size
     * @return Illuminate\Pagination\Paginator
     */
    public function getByQuery($params = [], $size = 25)
    {
        if (empty($params)) {
            return $this->model->paginate($size);
        }

        $params = array_except($params, ['page', 'limit']);
        $params['sort'] = array_get($params, 'sort', 'created_at:-1');

        $refClass = new \ReflectionClass($this->model);
        foreach ($params as $key => $value) {
            $filter = studly_case($key);
            if ($refClass->hasMethod("scope{$filter}")) {
                $filter = lcfirst($filter);
                $this->model = $this->model->$filter($value);
            }
        }
        return $this->model->paginate($size);
    }

    /**
     * Get record by ID.
     *
     * @param  array|int  $id
     * @param  boolean $withTrashed
     * @return Model
     */
    public function getById($id, $withTrashed = false)
    {
        return $withTrashed ? $this->model->withTrashed()->find($id)
            : $this->model->find($id);
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
        return $isBatch ? $this->model->insert($data)
            : $this->model->create($data);
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
            $record->fill($data)->save();
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
            return $isDestroy ? $record->forceDelete()
                : $record->delete();
        }
        return null;
    }

    /**
     * Restore a soft-deleted record
     *
     * @param  int $id
     * @return bool|null
     */
    public function restore($id)
    {
        if ($record = $this->getById($id, true)) {
            return $record->restore();
        }
        return null;
    }
}
