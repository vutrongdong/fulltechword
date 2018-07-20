<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ECOM') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <!-- Styles -->
    {{-- <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css"> --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/sweet-alert2/sweetalert2.min.css">
    <script src="/assets/js/modernizr.min.js"></script>
</head>
<body class="fixed-left">
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ url('/') }}" class="logo"><i class="icon-magnet icon-c-logo"></i><span>{{ config('app.name', 'Ecom') }}</span></a>
                    <!-- Image Logo here -->
                    <!--<a href="index.html" class="logo">-->
                        <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                        <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                    <!--</a>-->
                </div>
            </div>
            <nav class="navbar-custom">
                <ul class="list-inline float-right mb-0">
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="text-overflow"><small>Hi, {{ auth()->user()->name }}</small> </h5>
                            </div>

                            <!-- item-->
                            <router-link class="dropdown-item notify-item" to="/profile">
                                <i class="md md-account-circle"></i> <span>{{ __('Thông tin cá nhân') }}</span>
                            </router-link>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <i class="md md-settings-power"></i> <span>{{ __('Đăng xuất') }}</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-light waves-effect">
                            <i class="dripicons-menu"></i>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>

                        <li class="text-muted menu-title">{{ __('Menu') }}</li>

                        <li class="has_sub">
                            <router-link class="waves-effect" to="/"><i class="ti-home"></i> {{ __('Bảng điều khiển') }}</router-link>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-rss-alt"></i> <span> {{ __('Bài viết') }} </span> <span class="menu-arrow"></span> </a>
                            <ul class="list-unstyled">
                                @can('category.view', App\User::class)
                                <li>
                                    <router-link to="/categories">{{ __('Danh mục') }}</router-link>
                                </li>
                                @endcan
                                @can('blog.view', App\User::class)
                                <li>
                                    <router-link to="/blogs">{{ __('Bài viết') }}</router-link>
                                </li>
                                @endcan
                                @can('tag.view', App\User::class)
                                <li>
                                    <router-link to="/tags">{{ __('Tag') }}</router-link>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-settings"></i> <span> {{ __('Cài đặt') }} </span> <span class="menu-arrow"></span> </a>
                            <ul class="list-unstyled">
                                @can('manage-user', App\User::class)
                                <li>
                                    <router-link to="/users">{{ __('Tài khoản') }}</router-link>
                                </li>
                                @endcan

                                @can('roles.view', App\User::class)
                                <li>
                                    <router-link to="/role">{{ __('Phân quyền') }}</router-link>
                                </li>
                                @endcan

                                @can('config-site', App\User::class)
                                <li>
                                    <router-link to="/setting">{{ __('Cấu hình website') }}</router-link>
                                </li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <main>
            @yield('content')
        </main>
    </div>
    <script>
        var resizefunc = [];
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="/js/site.js" defer></script>
</body>
</html>
