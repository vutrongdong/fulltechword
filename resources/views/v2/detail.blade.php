@extends('v2.master')
@section('title',$detail->title)
@section('content')


<section id="one-post-detail">


    <div class="container">
        <div class="title-detail">
            <h1>{{$detail->title}}</h1>
        </div>
        <div class="icon-detail">
          <span> <i class="fa fa-calendar"></i>{{$detail->created_at}}</span>
          <span> <i class="fa fa-user"></i>{{$detail->author_id}}</span>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="img">
            <img src="{{$detail->getImage()}}" alt="{{$detail->image}}">
        </div>
        <div class="content">
            {!!$detail->content!!}
        </div>

    </div>


    @stop
    @section('content_footer')
    <div class="box">
        <div class="share container">
          <a href="#" class="facebook"><i class="fab fa-facebook"></i>Share</a>
          <a href="#" class="twitter"><i class="fab fa-twitter"></i>Tweet</a>
          <a href="#" class="google"><i class="fab fa-google"></i>Share</a>
          <a href="#" class="linkedin"><i class="fab fa-linkedin"></i>Share</a>
          <a href="#" class="youtube"><i class="fab fa-youtube"></i>Comments</a>
      </div>
  </div>
  <div class="clearfix"></div>
  <div class="img-bottom">
    <div class="container">
       <img class="container" src="{{ asset('V2/images/panner-bottom.png') }}" alt="">
   </div>
</div>
<div class="clearfix"></div>
<section id="latest-tori">
    <div class="container">
        <div class="title-latest-tori">
         <h3> Latest Stories</h3>
     </div>
     <div class="row">
      @foreach ($story as $element)
      <div class="col-lg-3 col-md-6 col-xs-12 padd0">
        <a href="{{ asset('detail') }}/{{ $element->id }}/{{ $element->slug }}">
        <img src="{{ $element->getImage() }}" alt="">
        <div class="icon-detail" style="color: #5b5b5b">
          <span> <i class="fa fa-calendar"></i>{{$element->created_at}}</span>
          <span> <i class="fa fa-user"></i>{{$element->author_id}}</span>
      </div>
  </a>
</div>
@endforeach



</div>
</div>
</section>
@endsection
