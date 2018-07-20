<?php

namespace FTW\Http\Controllers\API;

use Illuminate\Http\Request;
use FTW\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Get all permission from config file
     * @return json response
     */
    public function index()
    {
        $permissions = config('permissions');
        return response()->json($permissions, 200);
    }
}
