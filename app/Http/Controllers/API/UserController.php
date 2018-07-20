<?php

namespace FTW\Http\Controllers\API;

use Illuminate\Http\Request;
use FTW\Http\Controllers\Controller;
use FTW\Repositories\Users\UserRepository;
use FTW\Http\Requests\StoreUserRequest;
use FTW\Http\Requests\UpdateUserRequest;
use FTW\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->model = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection($this->model->getByQuery());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \FTW\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();
        $user = $this->model->store($request->all());

        // Sync with role
        if ($role = (array) $request->input('role')) {
            $user->roles()->attach($role);
        }

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->model->getById($id, true);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \FTW\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $request->validated();
        $user = $this->model->update($id, $request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
