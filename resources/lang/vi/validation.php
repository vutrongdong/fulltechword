<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Dữ liệu :attribute cần phải là accepted.',
    'active_url'           => 'Dữ liệu :attribute không phải một URL hợp lệ.',
    'after'                => 'Dữ liệu :attribute cần phải là một ngày sau :date.',
    'after_or_equal'       => 'Dữ liệu :attribute cần phải là một ngày sau hoặc bằng với :date.',
    'alpha'                => 'Dữ liệu :attribute chỉ chứa các ký tự.',
    'alpha_dash'           => 'Dữ liệu :attribute chỉ chứa các ký tự, số, và gạch chân.',
    'alpha_num'            => 'Dữ liệu :attribute chỉ chứa các ký tự và số.',
    'array'                => 'Dữ liệu :attribute cần phải là một mảng.',
    'before'               => 'Dữ liệu :attribute cần phải là một ngày trước :date.',
    'before_or_equal'      => 'Dữ liệu :attribute cần phải là một ngày trước hoặc bằng với :date.',
    'between'              => [
        'numeric' => 'Dữ liệu :attribute cần trong khoảng :min đến :max.',
        'file'    => 'Dữ liệu :attribute cần trong khoảng :min đến :max kilobytes.',
        'string'  => 'Dữ liệu :attribute cần trong khoảng :min đến :max ký tự.',
        'array'   => 'Dữ liệu :attribute cần chứa khoảng :min đến :max phần tử.',
    ],
    'boolean'              => 'Dữ liệu :attribute cần phải là true hoặc false.',
    'confirmed'            => 'Dữ liệu :attribute không chuẩn xác.',
    'date'                 => 'Dữ liệu :attribute không phải là một ngày hợp lệ.',
    'date_format'          => 'Dữ liệu :attribute không chuẩn xác với định dạng :format.',
    'different'            => 'Dữ liệu :attribute và :other cần phải khác nhau.',
    'digits'               => 'Dữ liệu :attribute cần phải là :digits số.',
    'digits_between'       => 'Dữ liệu :attribute cần trong khoảng :min đến :max số.',
    'dimensions'           => 'Dữ liệu :attribute không chuẩn xác kích thước của ảnh.',
    'distinct'             => 'Dữ liệu :attribute bị trùng.',
    'email'                => 'Dữ liệu :attribute cần phải là một địa chỉ email hợp lệ.',
    'exists'               => 'Dữ liệu :attribute không hợp lệ.',
    'file'                 => 'Dữ liệu :attribute cần phải là một file.',
    'filled'               => 'Dữ liệu :attribute cần phải có một giá trị điền vào.',
    'image'                => 'Dữ liệu :attribute cần phải là một ảnh.',
    'in'                   => 'Dữ liệu :attribute không hợp lệ.',
    'in_array'             => 'Dữ liệu :attribute không tồn tại trong :other.',
    'integer'              => 'Dữ liệu :attribute cần phải là một số nguyên.',
    'ip'                   => 'Dữ liệu :attribute cần phải là địa chỉ IP hợp lệ.',
    'ipv4'                 => 'Dữ liệu :attribute cần phải là địa chỉ IPv4 hợp lệ.',
    'ipv6'                 => 'Dữ liệu :attribute cần phải là địa chỉ IPv6 hợp lệ.',
    'json'                 => 'Dữ liệu :attribute cần phải là định dạng JSON hợp lệ.',
    'max'                  => [
        'numeric' => 'Dữ liệu :attribute không được lớn hơn :max.',
        'file'    => 'Dữ liệu :attribute không được lớn hơn :max kilobytes.',
        'string'  => 'Dữ liệu :attribute không được nhiều hơn :max ký tự.',
        'array'   => 'Dữ liệu :attribute không được nhiều hơn :max phần tử.',
    ],
    'mimes'                => 'Dữ liệu :attribute cần phải là một file kiểu: :values.',
    'mimetypes'            => 'Dữ liệu :attribute cần phải là một file kiểu: :values.',
    'min'                  => [
        'numeric' => 'Dữ liệu :attribute ít nhất là :min.',
        'file'    => 'Dữ liệu :attribute ít nhất là :min kilobytes.',
        'string'  => 'Dữ liệu :attribute ít nhất là :min ký tự.',
        'array'   => 'Dữ liệu :attribute ít nhất có :min phần tử.',
    ],
    'not_in'               => 'Dữ liệu :attribute không hợp lệ.',
    'not_regex'            => 'Dữ liệu :attribute không hợp lệ.',
    'numeric'              => 'Dữ liệu :attribute cần phải là một số.',
    'present'              => 'Dữ liệu :attribute cần phải được thể hiện.',
    'regex'                => 'Dữ liệu :attribute không hợp lệ.',
    'required'             => 'Dữ liệu :attribute là bắt buộc.',
    'required_if'          => 'Dữ liệu :attribute là bắt buộc khi :other bằng :value.',
    'required_unless'      => 'Dữ liệu :attribute là bắt buộc trừ khi :other bằng :values.',
    'required_with'        => 'Dữ liệu :attribute là bắt buộc chỉ khi :values được thể hiện.',
    'required_with_all'    => 'Dữ liệu :attribute là bắt buộc chỉ khi :values được thể hiện.',
    'required_without'     => 'Dữ liệu :attribute là bắt buộc chỉ khi :values không được thể hiện.',
    'required_without_all' => 'Dữ liệu :attribute là bắt buộc chỉ khi :values không được thể hiện.',
    'same'                 => 'Dữ liệu :attribute và :other phải tương đồng.',
    'size'                 => [
        'numeric' => 'Dữ liệu :attribute cần phải là :size.',
        'file'    => 'Dữ liệu :attribute cần phải là :size kilobytes.',
        'string'  => 'Dữ liệu :attribute cần phải là :size ký tự.',
        'array'   => 'Dữ liệu :attribute cần chứa :size phần tử.',
    ],
    'string'               => 'Dữ liệu :attribute cần phải là một chuỗi.',
    'timezone'             => 'Dữ liệu :attribute cần phải là vùng hợp lệ.',
    'unique'               => 'Dữ liệu :attribute đã tồn tại.',
    'uploaded'             => 'Dữ liệu :attribute không thể tải lên.',
    'url'                  => 'Dữ liệu :attribute không hợp lệ.',
];
