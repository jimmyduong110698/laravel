@extends('client.master')
@push('handlejs')
    <script type="module">
        import { CountdownToTime } from "../client/js/module.js";

        CountdownToTime(".single_product .place-bid");
    </script>
@endpush
@section('content')
@include('client.partials.banner')

<div class="browse_categories pt-80 pb-80"><!-- start category -->
    <div class="container"><!-- start container -->
        <div class="section_title">
            <h4 class="section-subtitle wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">Browse by category to choose your file. More than 4 Millions people love us without hesitation.</h4>
        </div><!-- end section title -->
        <div class="row"><!-- start row -->
            @foreach ($categories as $category)
            <div class="col-md-2 col-sm-4 col-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s"><!-- start col-2 -->
                <a href="{{route('client.collection',['id' => $category->id])}}" class="single_category category_box1">
                    <span class="category_icon">
                        <i class='bx {{$category->image}}'></i>
                    </span>
                    <span class="category_title">{{$category->name}}</span>
                </a>
            </div>
            @endforeach
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end category -->

<section id="nft_product_part" class="nft-product-area pt-50 pb-50"><!-- start explore products -->
    <div class="shape-relative">
        <div class="shape-explore1"></div>
        <div class="shape-explore2"></div>
    </div>
    <div class="container pt-50"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-6 col-sm-12 pb-10"><!-- start col-6 -->
                <div class="section_intro wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <p class="section_top_title">Live Auction</p>
                    <h2 class="section_heading">NTFs Products</h2>
                </div>
            </div><!-- end col-6 -->
            <div class="col-md-6 col-sm-12"><!-- start col-6 -->
                <div class="section_description">
                    <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">Explore on the world's best & largest NFT marketplace with our beautiful NFT products. We want to be a part of your smile, success and future growth. </p>
                </div>
            </div><!-- end col-6 -->
        </div><!-- end row -->
    </div><!-- end container -->		
    <div class="container"><!-- start container -->
        <div class="row"> <!-- start row -->
            @foreach ($items->slice(0, 9) as $item)
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
            <div class="col-md-12 pt-50 pb-30">
                <div class="all_nft-product-area text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                    <a href="{{route('client.explore')}}" class="btn btn_all_nft_product">View All Items <i class="bx bx-arrow-back"></i></a>
                </div>
            </div>
        </div> <!-- End row -->
    </div> <!-- End Container -->
</section><!-- end explore product -->

<section class="author-list-area pt-50 pb-50"><!-- start author list area -->
    <div class="container pt-50 mb-20"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-6 col-sm-12 pb-30">
                <div class="section_intro wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="section_heading">Our Amazing Authors</h2>
                    <div class="section_description">
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">Explore on the world's best & largest NFT marketplace with our beautiful NFT products. We want to be a part of your smile. </p>
                    </div>						
                </div>
            </div>
            <div class="col-md-6 float-right col-sm-12">
                <div class="author-btn">
                    <a href="{{route('client.author')}}" class="btn btn_authors">All Authors <i class="bx bx-arrow-back"></i></a>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->	
    <div class="container pb-20"> <!-- start Container -->
        <div class="row"><!-- start row -->
            @foreach ($authors->slice(0,8) as $author)
            <div class="col-md-3 col-sm-6 mb-30 mt-20"><!-- start col -->
                <div class="single-author-area"><!-- start single author -->
                    <div class="single-author-img">
                        <a href="{{route('client.detail',['id' => $author->id])}}" class="author_link">
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
        </div><!-- End row -->
    </div> <!-- End Container -->
</section><!-- end author list area -->

{{-- <div class="new_nft_product nft_product_features pt-50" id="nft-pro-slider"><!-- start new product slider -->
    <div class="container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-6 col-sm-12 pb-10">
                <div class="section_intro wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                    <p class="section_top_title">NTFs Products</p>
                    <h2 class="section_heading">Features Arworks</h2>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="section_description">
                    <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">Explore on the world's best & largest NFT marketplace with our beautiful NFT products. Be a part of your smile, success and future growth. </p>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="container new-proslider-homepage"><!-- start container -->
        <div id="owl-demo" class="owl-carousel new-proslider"><!-- start owl-carousel -->
            @foreach ($items->slice(0,9) as $item)
            <div class="single_product mt-50 pb-30"> <!-- Single Product -->
                <div class="jumbotron countdown show" data-Date='{{$item->end_date}}' data-endText="Auction ended">					
                    <div class="running">
                        <span class="timer">
                          <span class="days"></span>d
                          <span class="hours"></span>h
                          <span class="minutes"></span>m
                          <span class="seconds"></span>s
                        </span>							  
                    </div>
                </div> <!-- end count down -->
                <div class="profile-rating"> <!-- thumbsup rating -->
                    <i class='bx bx-heart'></i> 
                    <span class="thumbsup">2.1k</span>
                </div> <!-- end thumbsup rating -->						
                <div class="single_product_img"><!-- start single product img -->						
                    <a href="{{route('client.detail',['id'=>$item->id])}}" class="theme_preview_link">
                        <img src="{{ asset('client/img/items/'.rand(1,12).'.jpg') }}" alt="" class="responsive-fluid" />						
                    </a>
                </div> <!-- End single product img -->
                <div class="nft_product_description"><!-- start product description -->
                    <div class="nft_product_text">				
                        <ul class="author-profile-link slider_item_author"><!-- start author-->								
                            <li class="nav-item">
                                <a href="{{route('client.profile',['id' => $item->user_id])}}" class="author_link author-slider">
                                    <img src="{{ asset('client/img/avatar/'.rand(1,7).'.jpg') }}" alt="author" class="responsive-fluid img-1" />
                                    <i class='bx bxs-check-circle'></i>
                                </a>										
                            </li>							
                        </ul>	
                    </div><!-- end author-->																		
                    <div class="product_title_link slider_item"><!-- start product title-->			
                        <a class="product-title" href="{{route('client.detail',['id'=>$item->id])}}">
                            <h6 class="product_title_intro">{{$item->name}}</h6>	
                        </a>								
                    </div><!-- end product title-->		
                </div><!-- end product text -->
                <div class="nft_product_link pt-20 pb-10"><!-- start product link -->					
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
                    </ul>
                    <span class="place-bid-slider"><!-- start place bid -->
                        <a href="#" class="placebid slider-bid price" data-check="{{Auth::check()}}" data-toggle="modal" data-target="#popup_bid" data-url="{{route('client.bid_now')}}" data-id="{{$item->id}}">Bid Now</a>
                    </span><!-- end place bid -->							
                </div><!-- end product link -->								
            </div><!-- end Single Product -->
            @endforeach
        </div> <!-- End Product Caroseul -->
    </div> <!-- End container -->
</div><!-- End new product slider --> --}}

<div id="how-works" class="how-work-area pt-80 pb-80"><!-- start how work -->		
    <div class="container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-3 col-sm-6 mb-30"><!-- start col-3 -->
                <div class="single_feature_are how-one text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="why_icon">
                        <i class='bx bx-wallet-alt'></i>
                    </div>
                    <div class="why_text">
                        <h6 class="why_title">Connect your Wallet</h6>
                    </div>
                </div>
            </div><!-- end col-3 -->
            <div class="col-md-3 col-sm-6 mb-30"><!-- start col-3 -->
                <div class="single_feature_are how-two text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                    <div class="why_icon">
                        <i class='bx bx-notepad'></i>
                    </div>
                    <div class="why_text">
                        <h6 class="why_title">Create a Collection</h6>
                    </div>
                </div>
            </div><!-- end col-3 -->
            <div class="col-md-3 col-sm-6 mb-30"><!-- start col-3 -->
                <div class="single_feature_are how-three text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                    <div class="why_icon">
                        <i class='bx bx-pyramid'></i>
                    </div>
                    <div class="why_text">
                        <h6 class="why_title">Add NFT Products</h6>
                    </div>
                </div>
            </div><!-- end col-3 -->
            <div class="col-md-3 col-sm-6 mb-30"><!-- start col-3 -->
                <div class="single_feature_are how-four text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".9s">
                    <div class="why_icon">
                        <i class='bx bx-grid'></i>
                    </div>
                    <div class="why_text">
                        <h6 class="why_title">Ready for Sale</h6>
                    </div>
                </div>
            </div><!-- end col-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- End how work area -->		
@endsection