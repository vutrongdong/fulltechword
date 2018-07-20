<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="keywords" content=""/>
        <meta name="description" content="Goship là cách đơn giản nhất để ship hàng nhanh đi toàn quốc"/>
        <meta name="author" content="{{config('app.name', 'FullTechWord')}}"/>

        <link rel="canonical" href="" />
        <meta itemprop="name" content="{{config('app.name', 'FullTechWord')}}"">
        <meta itemprop="description" content="Goship là cách đơn giản nhất để ship hàng nhanh đi toàn quốc">
        <meta property="og:locale" content="vi_VN" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:url" content="https://goship.io/blogs" />
        <meta name="twitter:card" content="{{config('app.name', 'FullTechWord')}}"">
        <meta name="twitter:site" content=" ">
        <meta name="twitter:title" content="">
        <meta name="twitter:description" content="">
        <meta name="twitter:creator" content=" ">

        <title>{{ config('app.name', 'FullTechWord') }}</title>
        <link rel="shortcut icon" href="/images/favicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('css/frontend/v1/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{mix('/css/frontend/v1/site.css')}}">
        <link rel="stylesheet" href="{{asset('css/frontend/v1/pushy.css')}}">
        @yield('css')
    </head>
    <body>
        <!-- Pushy Menu -->
        <nav class="pushy pushy-left">
            <div class="pushy-content">
                    <ul>
                        @php
                            $traverse = function ($categories, $prefix = '-') use (&$traverse) {
                                foreach ($categories as $category) {
                                    if ($category->children) {
                                        echo '<li class="pushy-submenu pushy-submenu-open">';
                                        if (count($category->children)) {
                                            echo '<button>' . $category->name . '</button>';
                                        } else {
                                           echo '<a href="' . route('v1.category', $category->slug) . '">' . $category->name . '</a>';
                                        }
                                        echo '<ul>';
                                            $traverse($category->children, $prefix.'-');
                                        echo '</ul>';
                                        echo '</li>';
                                    } else {
                                        echo '<li class="pushy-link"><a href="' . route('v1.category', $category->slug) . '">' . $category->name . '</a></li>';
                                    }
                                }
                            };

                            $traverse($categories);
                        @endphp
                    </ul>
                    <!-- Submenu -->
            </div>
        </nav>

        <!-- Site Overlay -->
        <div class="site-overlay"></div>

        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleSearch">
                <form action="" method="get" accept-charset="utf-8">
                    <div class="p-4">
                        <div class="row">
                            <div class="input-group col-8 offset-2">
                                <input class="form-control py-2 border-right-0 border" type="search" value="Tìm kiếm" id="search-input">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        <section id="nav" class="container-fluid">
            <header class="header py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4 pt-1">
                        <span class="menu-btn">&#9776;</span>
                    </div>
                    <div class="col-4 text-center">
                        <a class="header-logo text-dark" href="{{route('v1.home')}}"> {{ config('app.name', 'FullTechWord') }} </a>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <a class="navbar-toggler text-secondary" data-toggle="collapse" data-target="#navbarToggleSearch" aria-expanded="false" aria-label="Toggle search"  class="text-muted" href="#">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                </div>
            </header>
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                    <a class="p-2 text-muted" href="{{route('v1.home')}}" title="Tất cả">Tất cả</a>
                    @foreach ($parentCategories as $category)
                        <a class="p-2 text-muted" href="{{route('v1.category', $category->slug)}}" title="{{ $category->name }}">{{ $category->name }}</a>
                    @endforeach
                </nav>
            </div>
        </section>
        <section id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        @yield('content')
                    </div>
                    <div class="col-12 col-lg-4">
                        <section class="blog-lastes py-5">
                            <section class="blog-lastest-title">
                                <h3>Bài viết mới</h3>
                            </section>
                            @foreach($blogLastest as $blog)
                                <section class="blog-lastest-item py-3">
                                    <a href="{{ route('v1.detail', $blog->slug) }}" title="{{ $blog->title }}">
                                        <div class="row">
                                            <div class="col-12 col-md-4 blog-lastest-image">
                                                <img src="{{$blog->getImage()}}" alt="{{$blog->title}}" class="img-fluid img-fit">
                                            </div>
                                            <div class="col-12 col-md-8 blog-lastest-title">
                                                <h3>
                                                    {{ $blog->title }}
                                                </h3>
                                            </div>
                                        </div>
                                    </a>
                                </section>
                            @endforeach

                        </section>
                    </div>
                </div>
            </div>
        </section>
        <footer id="footer">
            <p>Copyright &copy; KingDarkness {{ \Carbon\Carbon::now()->year }}</p>
        </footer>
        <script src="{{ mix('js/frontend/v1/site.js') }}"></script>
        <script src="{{ asset('js/frontend/v1/pushy.min.js') }}"></script>
        @yield('js')
    </body>
</html>
