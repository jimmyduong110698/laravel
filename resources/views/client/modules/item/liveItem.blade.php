@extends('client.master')
@push('handlejs')
    <script type="module">
        import { CountdownToTime } from "../client/js/module.js";

        CountdownToTime(".single_product .place-bid");
    </script>
@endpush
@push('css')
    <style>
        .search-container {
            margin: 0 auto;
        }
    </style>
@endpush
@section('content')
<div id="hero-slider-area" class="header-hero-area site-breadcrumb-header fix"> <!-- start header banner -->

    <!-- Start Breadcrumb
    ============================================= -->
    <div class="site-breadcrumb pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-200 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="breadcrumb-title">Live Auction</h2>
                    <ul class="breadcrumb-menu clearfix">
                        <li>
                            <a href="index.html">Home /</a> <a href="#" class="active">Auction</a>
                        </li>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->

<section id="nft_product_part" class="nft-product-area pt-50 pb-50"><!-- start explore products -->
    <div class="shape-relative">
        <div class="shape-explore1"></div>
        <div class="shape-explore2"></div>
    </div>
    <div class="container pt-50"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-4 col-sm-12 pb-30"><!-- start col -->
                <div class="section_intro wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="section_heading">Live Auction Artworks</h2>
                    <div class="section_description live_auction">
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">Explore on the world's best & largest NFT marketplace with our beautiful NFT products. We want to be a part of your smile. </p>
                    </div>						
                </div>
            </div><!-- end col -->
            <input type="hidden" name="url" data-url="{{route('client.filter_item')}}">
            <div class="col-md-4 col-sm-12 pb-30"><!-- start col -->
                <div class="menu_categories_area"><!-- start switch area -->
                    <ul class="menu_categories">
                        <li class="d-flex switch_item">
                            <label class="switch">
                                 <input type="checkbox" name="end_soon" id="end_soon" checked>
                                 <span class="slider round"></span>
                            </label>
                            <span class="ml-10 switch-text">Ending Soon </span>
                        </li><!-- end li -->
                        <li class="d-flex switch_item">
                            <label class="switch">
                                 <input type="checkbox" name="filter_date" id="filter_date">
                                 <span class="slider round"></span>
                            </label>
                            <span class="ml-10 switch-text"> Auction Ended</span>								
                        </li><!-- end li -->
                    </ul><!-- end ul -->
                </div>
            </div><!-- end col -->
            <div class="pt-15 col-md-4 col-sm-12"><!-- Start col-4 -->
                <div style="padding-top: 20px" class="form-group"><!-- Start form -->
                    <select name="sort_item" class="wide">									  
                        <option value="1">A -> Z</option>
                        <option value="2">Z -> A</option>
                        <option value="3">ETH ( low to high )</option>
                        <option value="4">ETH ( high to low )</option>
                    </select>								
                </div><!-- End form -->							
            </div><!-- End col-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="container pb-30"><!-- Start container -->
        <div class="row"><!-- Start row -->
            <div class="pt-15 col-md-3 col-sm-12"><!-- Start col-4 -->
                <div class="form-group"><!-- Start form -->
                    <select name="category" class="wide">
                        @php
                            $categories = DB::table('categories')->get();
                        @endphp
                        <option disabled selected>Choose Art</option>
                        <option value="0">Show all</option>				
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach							  
                    </select>								
                </div><!-- End form -->							
            </div><!-- End col-4 -->
            <div class="col-md-6 col-sm-12 text-center"><!-- Start col-4 -->		
                 <div class="search-container">
                    <div>
                        <input type="text" placeholder="Search here..." name="search" class="search-form">
                        <button type="submit" id="search_item" data-url="{{route('client.search')}}" class="search-icon"><i class='bx bx-search-alt'></i></button>
                    </div>
                 </div>				
            </div><!-- End col-4 -->
            <div class="pt-15 col-md-3 col-sm-12"><!-- Start col-4 -->
                <div class="form-group"><!-- Start form -->
                  <select class="wide"  name="state" id="maxRows">
                    <option value="6">6</option>
                    <option value="12">12</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="5000">Show ALL</option>
                  </select>								
                </div><!-- End form -->							
            </div><!-- End col-4 -->			
        </div><!-- End row -->
    </div><!-- End container -->		
    <div class="container"><!-- start container -->
        <div class="row" id="table-id"> <!-- start row -->
            @foreach ($items as $item)
            <div class="col-md-4 col-sm-12 wow fadeInUp item-code-{{$item->id}}" data-wow-duration="1s" data-wow-delay=".3s"><!-- start col-4 -->
                <div class="single_product mt-50 pb-30"> <!-- Single Product -->
                    <div class="jumbotron countdown show" data-Date='{{$item->end_date}}' data-beginDate='{{$item->begin_date}}' data-endText="@php
                        echo $item->begin_date > date ( 'Y-m-d H:i:s' ) ? "Pending start" : "Auction ended";
                    @endphp">					
                        <div class="running">
                            <span class="timer">
                              <span class="days"></span>d
                              <span class="hours"></span>h
                              <span class="minutes"></span>m
                              <span class="seconds"></span>s
                              </span>							  
                        </div>
                    </div> <!-- end count down -->
                    <div class="single_product_img"><!-- start single product img -->					
                        <a href="{{route('client.detail',['id' => $item->id])}}" class="theme_preview_link">
                            <img src="{{ asset('uploads/item/'.$item->image) }}" alt="" class="responsive-fluid" />						
                        </a>
                    </div> <!-- End single product img -->
                    <div class="nft_product_description"><!-- start product description -->
                        <div class="nft_product_text">				
                            <ul class="author-profile-link"><!-- start author-->								
                                <li class="nav-item">									
                                    <a href="author-details.html" class="author_link">
                                        <img src="{{ asset('uploads/avatar/'.$item->avatar) }}" alt="author" class="responsive-fluid img-2" />
                                        <i class='bx bxs-check-circle'></i>
                                    </a>	
                                    <span class="hover_author_link">
                                        <a href="#" class="author_link_text">{{$item->nick_name}}</a>
                                    </span>								
                                </li>
                            </ul>	
                        </div><!-- end author-->																		
                        <div class="product_title_link"><!-- start product title-->			
                            <a class="product-title" href="{{route('client.detail',['id' => $item->id])}}">
                                <h6 class="product_title_intro">{{$item->name}}</h6>	
                            </a>								
                        </div><!-- end product title-->		
                    </div><!-- end product text -->
                    <div class="nft_product_link"><!-- start product link -->					
                        <ul>
                            <li class="product-all-icon">
                                <span class="item-history product-icon">											
                                    <a href="#" class="item-history-btn" data-toggle="modal" data-target="#popup_history" data-url="{{route('client.bid_history')}}" data-id="{{$item->id}}">
                                        <i class='bx bx-comment-detail'></i>
                                    </a>											
                                </span>									
                            </li>
                                <li class="product-all-icon">										
                                    <span class="report-icon product-icon">
                                            <a href="#" class="report-link" data-toggle="modal" data-target="#popup_share">
                                                <i class='bx bxs-share-alt'></i>
                                            </a>
                                    </span>	
                                </li>
                                <li class="product-all-icon">										
                                    <span class="report-icon product-icon">
                                            <a href="#" class="report-link" data-toggle="modal" data-target="#popup_report">
                                                <i class='bx bxs-flag-alt'></i>
                                            </a>
                                    </span>	
                                </li>
                                <li class="product-all-icon">										
                                    <span class="sale-count product-icon">
                                            <span class="sale-counter show-price-{{$item->id}}">Unit: {{$item->price}} ETH</span>	
                                    </span>	
                                </li>										
                        </ul>
                    </div><!-- end product link -->		
                    @if ($item->end_date > date('Y-m-d H:i:s') && $item->begin_date < date('Y-m-d H:i:s'))
                    <div class="place-bid"><!-- start place bid -->
                        <a href="#" class="placebid price" data-toggle="modal" data-target=@php if (Auth::check()) {echo "#popup_bid";}  else {echo "#popup_bid_alert";} @endphp
                        data-bid-url="{{route('client.bid_success')}}" data-url="{{route('client.bid_now')}}" data-id="{{$item->id}}">Bid Now</a>
                    </div><!-- end place bid -->
                    @else
                    <div class="place-bid" data-date="{{$item->begin_date}}" data-url="{{ route('client.get_item',['id'=>$item->id]) }}" data-id="{{$item->id}}">
                        <a data-toggle="modal" data-target="popup_bid_cancel" href="#">Cancel</a>
                    </div>
                    @endif						
                </div><!-- end Single Product -->
            </div> <!-- End col-4 -->
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
</section><!-- end explore product -->
@endsection