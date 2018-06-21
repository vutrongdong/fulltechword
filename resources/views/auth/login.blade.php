@extends('layouts.auth')

@section('content')
<div>
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="card-box">
            <div class="panel-heading">
                <h4 class="text-center">Đăng nhập <strong class="text-custom">{{ config('app.name', 'Ecom') }}</strong></h4>
            </div>

            <div class="p-20">
                <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group ">
                        <div class="col-12">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Nhập email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Nhập mật khẩu" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup"> {{ __('Giữ đăng nhập') }}</label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
                                Đăng nhập
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-20 m-b-0">
                        <div class="col-12">
                            <a href="{{ route('password.request') }}" class="text-dark"><i class="fa fa-lock m-r-5"></i> Quên mật khẩu?</a>
                        </div>
                    </div>

                    <div class="form-group m-t-20 m-b-0">
                        <div class="col-12 text-center">
                            <h5 class="font-18"><b>Hoặc đăng nhập với</b></h5>
                        </div>
                    </div>

                    <div class="form-group m-b-0 text-center">
                        <div class="col-12">
                            <a href="{{ route('login-with-social', 'facebook') }}" class="btn btn-sm btn-facebook waves-effect waves-light m-t-20">
                               <i class="fa fa-facebook m-r-5"></i> Facebook
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p>
                    Chưa có tài khoản? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Đăng ký ngay</b></a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
