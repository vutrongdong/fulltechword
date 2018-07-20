<?php

namespace FTW\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use FTW\Http\Resources\Role as RoleResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'district' => [
                'id' => $this->district->id,
                'name' => $this->district->name
            ],
            'city' => [
                'id' => $this->city->id,
                'name' => $this->city->name
            ],
            'roles' => RoleResource::collection($this->roles),
            'created_at' => $this->created_at,
            'upated_at' => $this->updated_at
        ];
    }
}
