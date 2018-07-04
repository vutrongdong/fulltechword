<?php

namespace App\Repositories\Categories;

use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    /**
     * Category model.
     * @var Model
     */
    protected $model;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getToTree()
    {
        return $this->model->get()->toTree();
    }

    public function getToSelect()
    {
        $nodes = $this->getToTree();
        $returns = [];

        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$returns) {
            foreach ($categories as $category) {
                $category->name = $prefix ? $prefix . ' ' . $category->name : $category->name;
                $returns[] = $category;
                $traverse($category->children, $prefix.'-');
            }
        };

        $traverse($nodes);
        return $returns;
    }
}
