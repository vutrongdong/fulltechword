<?php

namespace FTW\Http\Controllers\API;

use Illuminate\Http\Request;
use FTW\Http\Controllers\Controller;
use FTW\Repositories\Settings\SettingRepository;

class SettingController extends Controller
{
    /**
     * SettingController constructor.
     * @param SettingRepository $setting
     */
    public function __construct(SettingRepository $setting)
    {
        $this->model = $setting;
    }

    /**
     * Get setting
     * @return [type] [description]
     */
    public function show()
    {
        return $this->model->getById(1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->model->update(1, $request->all());
    }
}
