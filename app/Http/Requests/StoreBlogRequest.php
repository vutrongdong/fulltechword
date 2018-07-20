<?php

namespace FTW\Http\Requests;

class StoreBlogRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required',
            'teaser'      => 'required|min:10|max:255',
            'content'     => 'required|min:30',
            'slug'        => 'required|unique:blogs,slug',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*.id'   => 'required|exists:tags,id',
        ];
    }

    /**
     * Print pretty message
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'       => 'Tiêu đề không được để trống.',
            'teaser.required'      => 'Giới thiệu ngắn không được để trống.',
            'teaser.min'           => 'Giới thiệu ngắn không được ít hơn :min ký tự.',
            'teaser.max'           => 'Giới thiệu ngắn không được lớn hơn :max ký tự.',
            'content.required'     => 'Nội dung không được để trống.',
            'content.min'          => 'Nội dung không được ít hơn :min ký tự.',
            'slug.required'        => 'slug không được để trống.',
            'slug.unique'          => 'slug đã tồn tại.',
            'category_id.required' => 'Vui lòng chọn một danh mục',
            'category_id.exists'   => 'Danh mục không tồn tại trên hệ thống',
            'tags.array'           => 'Tags không đúng định dạng',
            'tags.*.id.exists'     => 'Tag không tồn tại trên hệ thống'
        ];
    }
}
