<?php

namespace FTW\Repositories\Cities;

use FTW\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    /**
     * City model.
     * @var Model
     */
    protected $model;

    /**
     * CityRepository constructor.
     * @param City $city
     */
    public function __construct(City $city)
    {
        $this->model = $city;
    }
}
