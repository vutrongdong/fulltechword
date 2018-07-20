<?php

namespace FTW\Repositories\Settings;

use FTW\Repositories\BaseRepository;

class SettingRepository extends BaseRepository
{
    /**
     * Setting model.
     * @var Model
     */
    protected $model;

    /**
     * SettingRepository constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }
}
