<?php

namespace FTW\Repositories;

interface EntityInterface
{
    public function getAll();
    public function getByQuery($params, $size);
    public function getById($id, $withTrashed);
    public function store(array $data, $isBatch);
    public function update($id, array $data);
    public function delete($id, $isDestroy);
    public function restore($id);
}
