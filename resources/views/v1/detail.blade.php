@extends('v1.layouts.master')

@section('content')
    <section class="blog-list py-5">
        <div class="row">
            <div class="col-12">
                <h1>{{ $blog->title }}</h1>
                <p>
                    <i class="fa fa-calendar"></i> {{ $blog->created_at }} &nbsp;&nbsp;&nbsp;
                    @if($blog->author)
                        <i class="fa fa-user"></i> {{ $blog->author->name }}
                    @endif
                </p>

                <img src="{{ $blog->getImage() }}" alt="{{ $blog->title }}" class="img-fluid">

                <article>
                    {!! $blog->content !!}
                </article>
            </div>
        </div>
    </section>

    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BlogPosting",
        "headline": "{{ $blog->title }}",
        "image": "{{ $blog->getImage() }}",
        "award": "{{$blog->teaser}}",
        "editor": "{{ $blog->author ? $blog->author->name : 'anonymous' }}",
        "genre": "{{ url()->full() }}",
        "keywords": "seo sales b2b",
        "wordcount": "{{ strlen(strip_tags($blog->content)) }}",
        "publisher": "{{ $blog->author ? $blog->author->name : 'anonymous' }}",
        "url": "{{ url()->full() }}",
        "datePublished": "{{ $blog->created_at }}",
        "dateCreated": "{{ $blog->updated_at }}",
        "dateModified": "{{ $blog->created_at }}",
        "description": "{{ $blog->teaser }}",
        "articleBody": "{{ strip_tags($blog->content) }}",
        "author": {
            "@type": "Person",
            "name": "{{ $blog->author ? $blog->author->name : 'anonymous' }}"
        }
    }
    </script>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/codesample/css/prism.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/codesample/js/prism.js') }}" type="text/javascript" charset="utf-8"></script>
@endsection
