<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="@yield('canonical')" />

    <meta name="twitter:card" content="{{config('app.name', 'FullTechWord')}}">
    <title> @yield('title') </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('V2/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('V2/css/home.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('V2/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('V2/css/detail.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
   <section id="header">
    <div>
        <div class="top_bar">
            <div class="container">
                <span style="float:right;" class="top-follow"><a href="#follow-us">Follow us</a>
                    <a href="#""><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i  class="fab fa-twitter"></i></a>
                    <a href="#">in</a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-rss"></i></a>
                </span>
            </div>
        </div>
        <div class="header-top container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-xs-8 header-left">
                    <img id="logo" src="{{ asset('V2/images/logo.png') }}" alt="">
                </div>
                <div class="col-lg-4 col-md-4 col-xs-4 text-center header-right">
                   <a href="#" class="btn btn-success"> <h3>Subscribe to Newsletter</h3></a>

               </div>
           </div>
       </div>
       <div class="background">
        <div class="header-menu container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <!-- Toggler/collapsibe Button -->
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    @foreach ($menu as $cate)

                    @if($cate->id == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('category') }}/{{ $cate->id }}/{{ $cate->slug }}">{{$cate->name}}</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('category') }}/{{ $cate->id }}/{{ $cate->slug }}" title="{{$cate->slug }}">{{$cate->name}}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="sreach marRight7">
                <a href="#collapseExample"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample">
                    <div class="search-here"><i aria-hidden="true" class="fa fa-search"></i></div>
                </a>
            </div>

            <div class="menu2 marRight7" style="float:right;margin-left: 50px;">
                <span cursor:pointer" data-toggle="modal" data-target="#myModal" >&#9776;</span>
            </div>

            {{--  --}}
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <p style="color: red;float:left;">Menu</p>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="#">Clients</a>
                    <a href="#">Contact</a>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>

      </div>
  </div>
  {{--  --}}
</nav>
</div>

</div>
</div>

<div class="collapse" id="collapseExample" style="background: rgb(248, 249, 250) !important;">
  <div class="container">
          <form method="get" action="{{ asset('search') }}">
         {{ csrf_field() }}

        <div class="form-group">
            <input type="text" class="form-control" name="keyword" placeholder="Search here...">
        </div>
    </form>
</div>
</div>
</section>
<div class="clearfix"></div>
@yield('content')

{{-- right --}}
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 hidden-md-down hidden-xs-down" id="banner">
    <div class="banner-right">
        <img src="{{ asset('V2/images/action1.jpg') }}" alt="">
        <h6 class="link text-right">
         <a href="#"  title="Sponsored">Sponsored</a>
     </h6>

 </div>

 <div class="banner-right">
    <img src="{{ asset('V2/images/action2.gif') }}" alt="">
    <h6 class="link text-right">
        <a href="#"  title="Sponsored">Sponsored</a>
    </h6>

</div>
<div class="details-post-right">
    <div class="title-post-right">
       <h3>Popular News</h3>
   </div>
   @foreach ($news as $post)
   <a href="{{ asset('detail') }}/{{ $post->id }}/{{ $post->slug }}" title="{{ $post->title }}">
    <div class="right">
     <div class="details-post-image">
        <img src="{{$post->getImage()}}"  alt="{{ $post->image }}">
    </div>

    <h4 class="details-post-title">
        {{$post->title}}
    </h4>
</div>
</a>
<div class="clearfix"></div>
@endforeach
</div>

</div>

</div>

</div>
</div>
</section>

{{-- end right --}}
@yield('content_footer')

<section id="best-deal">
    <div class="container">
        <div class="title">
            <h2> Best Deals</h2>
        </div>
        <div class="row paddTop-20">
            @foreach ($hots as $hot)
            <div style="margin-top: 20px;" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ asset('detail') }}/{{ $hot->id }}/{{ $hot->slug }}" title="{{ $hot->title }}">
                  <img src="{{  $hot->getImage() }}" alt="{{ $hot->image }}">
                  <div class="price-best-deal" style="color: #5b5b5b">
                     <span> <i class="fa fa-calendar"></i>{{$hot->created_at}}</span>
                     <span> <i class="fa fa-user"></i>{{$hot->author}}</span>
                 </div>
             </a>

         </div>
         @endforeach
         <div class="clearfix"></div>

     </div>
 </div>
</section>
<div class="clearfix"></div>
<section id="form-home" style='clear:both;'>
    <div class="container-fluid">
        <div class="row">
            <div class="offset-lg-3 col-lg-6 col-md-12 col-xs-12">
                <form method="post">
                  <h3><i aria-hidden="true" class="fa fa-bolt"></i> Newsletter — Subscribe for Free</h3>
                  <p>Join over 500,000 information security professionals — Get the best of our cyber security coverage delivered to your inbox every morning.</p>
                  <div class="form-group email">
                      <input style="height: 48px;" type="email" class="form-control" name="email" placeholder="enter email...">
                      <button style="margin: 5px; padding: 6px 20px;border: none; background: #00ace5;" type="submit" class="btn btn-primary fix-submit"> > </button>

                  </div>
              </form>
          </div>
      </div>
  </div>
</section>

<section id="home-footer">
    <div class="container">
     <div class="title-footer">
       <h5> Follow Us</h5>
   </div>
   <div class="row">
     <div class="col-lg-2 col-md-4 col-sm-6 col-xs-4">
        <div class="social-box s-tw">
            <a href="#" title=""><i aria-hidden="true" class="fab fa-twitter"></i>
                <div class="sb-text">485,000 Followers</div>
            </a>

        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-4">
     <div class="social-box s-fb">
         <a href="" title="">
             <i aria-hidden="true" class="fab fa-facebook"></i>
             <div class="sb-text">2,090,200 Followers</div>
         </a>

     </div>

 </div>
 <div class="col-lg-2 col-md-4 col-sm-6 col-xs-4">
    <div class="social-box s-in">
        <a href="" title="">
            <i aria-hidden="true" class="fab fa-linkedin"></i>
            <div class="sb-text">6,600 Fans</div>
        </a>
    </div>
</div>

<div class="col-lg-2 col-md-4 col-sm-6 col-xs-4">
 <div class="social-box s-gp">
  <a href="" title="">
    <i aria-hidden="true" class="fab fa-google-plus"></i>
    <div class="sb-text">1,900,350 Followers</div>
</a>
</div>
</div>

<div class="col-lg-2 col-md-4 col-sm-6 col-xs-4">
 <div class="social-box s-yt">
  <a href="" title="">
    <i aria-hidden="true" class="fab fa-youtube"></i>
    <div class="sb-text">5,600 Subscribers</div>
</a>
</div>
</div>

<div class="col-lg-2 col-md-4 col-sm-6 col-xs-4">
 <div class="social-box s-it">
  <a href="" title="">
    <i aria-hidden="true" class="fab fa-instagram"></i>
    <div class="sb-text">36,000 Followers</div>
</a>
</div>
</div>

</div>

<div class="menu-footer">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-4 col-xs-12">
            <div class="title-footer-menu">
             <h5> About </h5>
         </div>

         <div class="menu-footer">
             <ul>
                 <li><a href="" title="">About Us</a></li>
                 <li><a href="" title="">Advertising</a></li>
                 <li><a href="" title="">Write For Us</a></li>
                 <li><a href="" title="">Editorial Team</a></li>
                 <li><a href="" title="">Contact</a></li>
             </ul>
         </div>

     </div>

     <div class="col-lg-3 col-md-6 col-sm-4 col-xs-12">
        <div class="title-footer-menu">
         <h5> Pages </h5>
     </div>

     <div class="menu-footer">
         <ul>
             <li><a href="" title="">RSS Feeds</a></li>
             <li><a href="" title="">Deals Store</a></li>
             <li><a href="" title="">AdChoices</a></li>
             <li><a href="" title="">Privacy Policy</a></li>
             <li><a href="" title="">Copyright Policy</a></li>
         </ul>
     </div>

 </div>

 <div class="col-lg-3 col-md-6 col-sm-4 col-xs-12">
    <div class="title-footer-menu">
     <h5> Deals </h5>
 </div>

 <div class="menu-footer">
     <ul>
         <li><a href="" title="">Exclusives</a></li>
         <li><a href="" title="">Hacking</a></li>
         <li><a href="" title="">Development</a></li>
         <li><a href="" title="">Android</a></li>
         <li><a href="" title="">Apple/Mac</a></li>
     </ul>
 </div>

</div>


<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
 <a href="" title="">
  <div class="f-menu-bt">
    <i aria-hidden="true" class="fa fa-rss"></i>
    RSS Feeds
</div>
</a>

<a href="" title="">
  <div class="f-menu-bt">
    <i aria-hidden="true" class="fa fa-envelope"></i>
    RSS Feeds
</div>
</a>

<a href="" title="">
  <div class="f-menu-bt">
    <i aria-hidden="true" class="fa fa-telegram"></i>
    RSS Feeds
</div>
</a>
</div>

</div>
</div>

</div>
</section>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#openNav").click(function(){
            $("#mySidenav").css('width','250px');
            $("#main").css('marginLeft','250px');

        });

        $("#closeNav").click(function(){
         $("#mySidenav").css('width','0');
         $("#main").css('marginLeft','0');
     });

        $(window).scroll(function(){

            if($(window).scrollTop() <300){

                $(".icon-bar").removeClass('addicon');

            }

            else if($(window).scrollTop() >1600){
                $(".icon-bar").removeClass('addicon');
                $(".icon-bar").addClass('vivisibility');

            }
            else{
                $(".icon-bar").addClass('addicon');
                $(".icon-bar").removeClass('vivisibility');

            }

        });

    });


</script>
</body>
</html>
