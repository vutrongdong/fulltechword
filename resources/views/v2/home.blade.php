
@extends('v2.master')
@section(' title ','home')
@section('canonical', 'http://fulltechword.test/' )
@section('content')
<section id="post">
   <div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

          @foreach ($value as $blog)
          <a href="{{ asset('detail') }}/{{ $blog->id }}/{{ $blog->slug }}">
              <div class="row" style="margin-bottom: 20px;">
                <div class="img col-lg-5 col-md-5 col-sm-5 col-xs-5">
                  <img  src="{{ $blog->getImage() }}"  alt="$blog->title">
              </div>
              <div class="details col-lg-7 col-md-7 col-sm-7 col-xs-7">
                <h3 class="title">
                 {{$blog->title}}
             </h3>
             <div class="item-label">
              <span> <i class="fa fa-calendar"></i>{{$blog->created_at}}</span>
              <span> <i class="fa fa-user"></i>{{$blog->author}}</span>
          </div>
          <p class="home-content">
            {{ $blog->teaser }}
        </p>
    </div>
</div>
</a>
@endforeach
{{$value->links()}}
<div class="clearfix"></div>
</div>

@stop
