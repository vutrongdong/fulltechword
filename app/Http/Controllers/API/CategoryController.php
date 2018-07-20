<?php

namespace FTW\Http\Controllers\API;

use FTW\Http\Controllers\Controller;
use FTW\Repositories\Categories\CategoryRepository;
use FTW\Http\Requests\StoreCategoryRequest;
use FTW\Http\Requests\EditCategoryRequest;
use FTW\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->model = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('category.view');
        return CategoryResource::collection($this->model->getByQuery($request->all()));
    }

    /**
     * Display a  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $model  = $this->model->getById($id);
        $this->authorize('category.view', $model);
        return new CategoryResource($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \FTW\Http\Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('category.create');
        $request->validated();
        return new CategoryResource($this->model->store($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \FTW\Http\Requests\EditCategoryRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoryRequest $request, $id)
    {
        $this->authorize('category.update', $this->model->getById($id));
        $request->validated();
        return new CategoryResource($this->model->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rs = $this->model->delete($id);
        $this->authorize('category.delete', $rs);
        return response()->json([], is_null($rs) ? 422 : 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToTree(Request $request)
    {
        $this->authorize('category.view');
        return response()->json(['data' => $this->model->getToTree()], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToSelect(Request $request)
    {
        $this->authorize('category.view');
        return response()->json(['data' => $this->model->getToSelect()], 200);
    }
}
