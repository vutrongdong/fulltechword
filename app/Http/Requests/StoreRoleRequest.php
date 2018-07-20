<?php

namespace FTW\Http\Requests;

class StoreRoleRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * Print pretty message
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên vai trò không được để trống.'
        ];
    }
}
