@extends('client.master')
@push('css')
    <style>
        input.btn_follow {
            border: none;
            padding: 8px 20px;
            background: var(--btn-color);
            border-radius: 0.5rem;
            position: relative;
            color: var(--black-color);
            font-weight: 500;
            transition: all ease .4s;
        }
        input.btn_follow:hover {
            background: var(--btnbg-color);
            text-decoration: none !important;
            outline: none !important;
            box-shadow: none !important;
            color: #fff;
        }
        .timeline-bg {
            width: 100%;
        }
    </style>
@endpush
@push('handlejs')
    <script id="myscript">
        $(document).on('click',"input[name='btn_follow']",function () {
            var url = $(this).data("url");
            var followID = $(this).data("follow");
            let a = $(this);

            $.ajax({
                type: "POST",
                url: url,
                data: { followID: followID },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    console.log("button_follow_"+followID)
                    $("#button_follow_"+followID).html(" ");
                    $("#button_follow_"+followID).append(`
                    <input class="btn_follow" type="button" value="Unfollow" data-url="http://127.0.0.1:8000/unfollow" data-follow="${response.result}" name="btn_unfollow" >
                    `);
                }
            });
        });
        $(document).on('click',"input[name='btn_unfollow']",function () {
            var url = $(this).data("url");
            var followID = $(this).data("follow");
            let a = $(this);

            $.ajax({
                type: "POST",
                url: url,
                data: { followID: followID },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    console.log("button_follow_"+followID)
                    $("#button_follow_"+followID).html(" ");
                    $("#button_follow_"+followID).append(`
                    <input class="btn_follow" type="button" value="Follow" data-url="http://127.0.0.1:8000/follow" data-follow="${response.result}" name="btn_follow" >
                    `);
                }
            });
        });
    </script>
@endpush
@section('content')
<div id="hero-slider-area" class="header-hero-area site-breadcrumb-header fix"> <!-- start header banner -->

    <!-- Start Breadcrumb
    ============================================= -->
    <div class="site-breadcrumb pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-200 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="breadcrumb-title">Authors List</h2>
                    <ul class="breadcrumb-menu clearfix">
                        <li>
                            <a href="index.html">Home /</a> <a href="#" class="active">Authors</a>
                        </li>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->	


<section class="feature-author-list-area pt-50 pb-40"><!-- start author list area -->
    <div class="container pt-50 mb-20"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-7 col-sm-12 pb-30">
                <div class="section_intro wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="section_heading">Featured Authors</h2>
                    <div class="section_description">
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">Explore on the world's best & largest NFT marketplace with our beautiful NFT products. We want to be a part of your smile. </p>
                    </div>						
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->	
    <div class="container pb-30"> <!-- start Container -->
        <div class="row"><!-- start row -->
            @foreach ($authors->slice(0,11) as $author)
            <div class="author_count col-md-3 col-sm-6 mb-30 mt-20"><!-- start col -->
                <div class="single-author-area"><!-- start single author -->
                    <div class="single-author-img">
                        <a href="{{route('client.profile',['id'=>$author->id])}}" class="author_link offline">
                            <img src="{{ asset('uploads/avatar/'.$author->avatar) }}" alt="author" class="responsive-fluid img-1">
                        </a>
                        <div class="name-amount">
                            <a href="{{route('client.profile',['id'=>$author->user_id])}}" class="author_link_text">{{$author->nick_name}}</a>
                            <p class="eth-amount"> <span class="total-items">Total items : </span>{{$author->count}}</p>								
                        </div>
                    </div><!-- end single author image -->
                    <div id="@php echo "button_follow_".$author->user_id @endphp" class="follow-icon-otr single-author-btn text-center">
                        @if (Auth::check())
                        <input type="button" class="btn_follow" @php
                        $check = DB::table('follow')->where('user_id',Auth::user()->id)->where('follow_id',$author->user_id)->get();
                            if (!empty($check[0]) && $check[0]->status == 1) {
                                echo " name='btn_unfollow' data-url=".route('client.unfollow')." data-follow=".$author->user_id." value='Unfollow'";
                            } else {
                                echo " name='btn_follow' data-url=".route('client.follow')." data-follow=".$author->user_id." value='Follow'";
                            }
                        @endphp>
                        @else
                            <a class="btn_follow" href="{{route('login')}}">Follow</a>
                        @endif 
                    </div><!-- end follow link -->						
                </div><!-- end single author -->
            </div><!-- end col -->
            @endforeach
        </div><!-- End row -->
    </div> <!-- End Container -->
</section><!-- end author list area -->

<div id="author-slider-id" class="author-slider-area authors-page-area pb-100"><!-- start collection product -->
    <div class="container pt-100"><!-- start container -->
        <div class="row wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s"><!-- start row -->
            <div class="col-md-12 col-sm-12">
                <div class="section_intro text-center">
                    <h2 class="section_heading">Popular Authors Counting</h2>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->		
    <div class="container slick-container pt50"><!-- start container -->
        <div class="slick-slider-authors mb-30"> <!-- Start slider -->
            @foreach ($authors->slice(0,11) as $author)
            <div class="author-slider-single"><!-- Start author slider single -->
                <div class="timeline-area">
                    <img src="{{ asset('uploads/item/'.$author->image) }}" alt="author timeline" class="responsive-fluid timeline-bg" />
                    <div class="timeline-author-img">
                        <a href="{{route('client.profile',['id'=>$author->id])}}" class="timeline-author-link">
                            <img src="{{ asset('uploads/avatar/'.$author->avatar) }}" alt="author" class="responsive-fluid" />						
                        </a>
                    </div>
                </div>
                <div class="timeline-bottom-area"><!-- Start timeline bottom area -->
                    <div class="timeline-author-area">
                        <a href="{{route('client.profile',['id'=>$author->id])}}" class="author-name">{{$author->nick_name}}</a>			
                        <p class="timeline-items"><span class="timeline-count">01</span> artworks</p>
                    </div>
                </div><!-- end timeline bottom area -->
            </div><!-- end author slider single -->
            @endforeach
        </div> <!-- End slider -->					
    </div> <!-- End Container -->
</div> <!-- End collection Product -->	

<div id="authors_area" class="dark-bg-all pb-50 pt-100"><!-- start authors area-->
    <div class="container pb-20"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-6 col-sm-12 pb-30"><!-- start col-6 -->
                <div class="section_intro wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <p class="section_top_title">Authors list</p>
                    <h2 class="section_heading">Our Amazing Artists</h2>
                </div>
            </div><!-- end col-6 -->
            <div class="col-md-6 col-sm-12"><!-- start col-6 -->
                <div class="section_description">
                    <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">Explore on the world's best & largest NFT marketplace with our beautiful NFT products. We want to be a part of your smile. </p>
                </div>
            </div><!-- end col-6 -->
        </div><!-- end row -->
    </div><!-- end container -->	
    <div class="container pb-30"><!-- Start container -->
        <div class="row"><!-- Start row -->
            <div class="pt-15 col-md-3 col-sm-12"><!-- Start col-4 -->
                <div class="form-group"><!-- Start form -->
                  <select class="wide">
                    <option disabled selected>Choose Art</option>											  
                    <option value="0">Domains</option>
                    <option value="1">3D Art</option>
                    <option value="2">Artworks</option>
                    <option value="3">Memes</option>
                    <option value="4">Video Clips</option>
                    <option value="5">Virtual Games</option>
                    <option value="6">Animation</option>
                  </select>								
                </div><!-- End form -->							
            </div><!-- End col-4 -->
            <div class="col-md-6 col-sm-12 text-center"><!-- Start col-4 -->		
                 <div class="search-container">
                    <form action="#?">
                        <input type="text" placeholder="Search here..." name="search" class="search-form">
                        <button type="submit" class="search-icon"><i class='bx bx-search-alt'></i></button>
                    </form>
                 </div>				
            </div><!-- End col-4 -->
            <div class="pt-15 col-md-3 col-sm-12"><!-- Start col-4 -->
                <div class="form-group"><!-- Start form -->
                  <select class="wide"  name="state" id="maxRows">
                    <option value="6">6</option>
                    <option value="12">12</option>
                    <option value="24">24</option>
                    <option value="5000">Show ALL Rows</option>
                  </select>								
                </div><!-- End form -->							
            </div><!-- End col-4 -->			
        </div><!-- End row -->
    </div><!-- End container -->		
    <div class="container"><!-- start container -->
        <div class="row" id="table-id"> <!-- start row -->
            @foreach ($authors->slice(0,11) as $author)
            <div class="col-md-4 col-sm-6 mb-30 mt-20 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s"><!-- start col -->
                <div class="single-author-area"><!-- start single author -->
                    <div class="single-author-img">
                        <a href="{{route('client.profile',['id'=>$author->id])}}" class="author_link">
                            <img src="{{ asset('uploads/avatar/'.$author->avatar) }}" alt="author" class="responsive-fluid img-1">
                            <i class="bx bxs-check-circle"></i>
                        </a>
                        <div class="name-amount">
                            <a href="{{route('client.profile',['id'=>$author->id])}}" class="author_link_text">{{$author->nick_name}}</a>
                            <p class="eth-amount"> <span class="total-items">Total items : </span>{{$author->count}}</p>
                        </div>
                    </div><!-- end single author image -->
                </div><!-- end single author -->
            </div><!-- end col -->
            @endforeach 
        </div> <!-- End row -->
        <div class="row"><!-- start row -->
            <div class="col-md-12 pt-20"> <!-- start col -->
                <div class="pagination-area pagination-container">
                    <ul class="pagination product_list">                 
                        <li class="page-number" data-page="prev">
                        <span>
                            < <span class="sr-only page-number">(current)
                        </span></span>
                        </li>
                        <!--	Here the JS Function Will Add the Rows -->
                        <li class="page-number" data-page="next" id="prev">
                            <span> > <span class="sr-only page-number">(current)</span></span>
                        </li>
                    </ul>					
                </div>				
            </div> <!-- end col -->
        </div> <!-- End row -->
    </div> <!-- End Container -->
</div><!-- end authors area -->
@endsection