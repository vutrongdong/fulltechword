<?php

namespace FTW\Repositories\Roles;

use FTW\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    /**
     * Role model.
     * @var Model
     */
    protected $model;

    /**
     * RoleRepository constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
}
