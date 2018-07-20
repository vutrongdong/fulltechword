<?php

namespace FTW\Http\Requests;

class StoreCategoryRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
        ];
    }

    /**
     * Print pretty message
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'slug.required' => 'slug không được để trống.',
            'slug.unique'   => 'slug đã tồn tại.',
            // 'phone.digits_between' => 'Số điện thoại cần nằm trong khoảng :min đến :max số',
        ];
    }
}
