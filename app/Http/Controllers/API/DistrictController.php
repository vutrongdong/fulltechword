<?php

namespace FTW\Http\Controllers\Api;

use Illuminate\Http\Request;
use FTW\Http\Controllers\Controller;
use FTW\Repositories\Districts\DistrictRepository;

class DistrictController extends Controller
{
    /**
     * DistrictController constructor.
     * @param DistrictRepository $district
     */
    public function __construct(DistrictRepository $district)
    {
        $this->model = $district;
    }

    /**
     * Listing district by city
     *
     * @return \Illuminate\Http\Response
     */
    public function getByCity(Request $request, $cID)
    {
        return $this->model->getByCity($cID);
    }
}
