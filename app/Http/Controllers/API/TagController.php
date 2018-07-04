<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Tags\TagRepository;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\EditTagRequest;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * TagController constructor.
     * @param TagRepository $tag
     */
    public function __construct(TagRepository $tag)
    {
        $this->model = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('tag.view');
        return TagResource::collection($this->model->getByQuery($request->all()));
    }

    /**
     * Display a  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $model  = $this->model->getById($id);
        $this->authorize('tag.view', $model);
        return new TagResource($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $this->authorize('tag.create');
        $request->validated();
        return new TagResource($this->model->store($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditTagRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTagRequest $request, $id)
    {
        $this->authorize('tag.update', $this->model->getById($id));
        $request->validated();
        return new TagResource($this->model->update($id, $request->all()));
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
        $this->authorize('tag.delete', $rs);
        return response()->json([], is_null($rs) ? 422 : 200);
    }
}
