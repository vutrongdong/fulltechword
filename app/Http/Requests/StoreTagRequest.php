<?php

namespace FTW\Http\Requests;

class StoreTagRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required',
            'slug'        => 'required|unique:tags,slug,' . $this->input('id'),
        ];
    }

    /**
     * Print pretty message
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => 'Tên không được để trống.',
            'slug.required'        => 'slug không được để trống.',
            'slug.unique'          => 'slug đã tồn tại.'
        ];
    }
}
