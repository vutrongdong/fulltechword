@extends('v1.layouts.master')

@section('content')
    <section class="blog-list py-5">
        @if(count($blogs))
            @foreach ($blogs as $blog)
                <section class="blog-item py-3">
                    <a href="{{ route('v1.detail', $blog->slug) }}" title="{{ $blog->title }}">
                        <div class="row">
                            <div class="col-12 col-md-5 col-lg-4 blog-image">
                            <img src="{{ $blog->getImage() }}" alt="{{ $blog->title }}" class="img-fluid img-fit">
                            </div>
                            <div class="col-12 col-md-7 col-lg-8 blog-teaser">
                            <h2 class="blog-title">{{ $blog->title }}</h2>
                                <div class="blog-meta">
                                <span class="blog-create-time"><i class="fa fa-calendar"></i> {{ $blog->created_at }}</span> &nbsp;&nbsp;
                                <span class="blog-author"><i class="fa fa-user"></i> {{ $blog->author }}</span>
                                </div>
                                <div class="blog-teaser-content text-justify">
                                    {{$blog->teaser}}
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
            @endforeach
        @else
            <section class="text-center">
                Không có bài viết nào
            </section>
        @endif
    </section>

    <section class="blog-paginate">
        {{ $blogs->links() }}
    </section>

@endsection
