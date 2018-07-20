<?php

namespace FTW\Http\Controllers\Api;

use Illuminate\Http\Request;
use FTW\Http\Controllers\Controller;
use FTW\Repositories\Cities\CityRepository;

class CityController extends Controller
{
    /**
     * CityController constructor.
     * @param CityRepository $city
     */
    public function __construct(CityRepository $city)
    {
        $this->model = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->getAll();
    }
}
