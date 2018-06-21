<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Roles\RoleRepository;
use App\Http\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    /**
     * RoleController constructor.
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->model = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('roles.view', App\User::class);
        return $this->model->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('roles.create', App\User::class);
        $request->validated();
        return $this->model->store($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, $id)
    {
        $this->authorize('roles.update', App\User::class);
        $request->validated();
        return $this->model->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roles.delete', App\User::class);
        $rs = $this->model->delete($id);
        return response()->json([], is_null($rs) ? 422 : 200);
    }
}
