@extends('layouts.auth')

@section('content')
<div>
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="card-box">
            <div class="p-20">
                <h3>Yêu cầu của bạn không được thực hiện</h3>
                <p>Thông tin mô tả lỗi mà hệ thống thu thập được là như sau:</p>
                <p>{{ $error }}</p>
                <hr>
                <p>Bạn có thể <a href="/" title="Quay lại trang chủ">Quay lại trang chủ</a> để thử lại yêu cầu.</p>
            </div>
        </div>
    </div>
</div>
@endsection
