@extends('client.master')

@section('content')
<div id="hero-slider-area" class="header-hero-area site-breadcrumb-header fix"> <!-- start header banner -->

    <!-- Start Breadcrumb
    ============================================= -->
    <div class="site-breadcrumb pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-200 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="breadcrumb-title">Detail - {{$item->name}}</h2>
                    <ul class="breadcrumb-menu clearfix">
                        <li>
                            <a href="/">Home /</a> <a href="{{route('client.explore')}}">Explore /</a> <a href="{{route('client.detail',['id' => $item->id])}}" class="active">Etherino</a>
                        </li>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->

<!-- Start Modal Popup -->	

<section class="product_slider_area item-details-area live_product_bg"><!-- start product slider area -->	
    <div class="container"><!-- start container -->		
        <div class="single_slide pt-100"><!-- start single slide -->	
            <div class="row"><!-- start row -->								
                <div class="col-md-5 col-sm-12 pb-50"><!-- start col -->	
                    <div class="slider_text_area single_product single_item_details wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="nft_product_text slide-auction">				
                            <ul class="author-profile-link text-center"><!-- start author-->					
                                <li class="nav-item">									
                                    <a href="author-details.html" class="author_link author-slider-c">
                                        <img src="{{ asset('uploads/avatar/'.$item->avatar) }}" alt="author" class="responsive-fluid img-2" />
                                        <i class='bx bxs-check-circle'></i>
                                    </a>	
                                    <span class="hover_author_link">
                                        <a href="author-details.html" class="author_link_text">{{$item->nick_name}}</a>
                                    </span>								
                                </li>
                            </ul>	
                        </div><!-- end author-->								
                        <div class="slide-header item-details-header text-left">
                            <h2 class="explore_title section_heading">{{$item->name}}</h2>
                            <p class="item-details-text mt-10">{{$item->content}}</p>
                        </div><!-- end slide header -->	
                        <div class="slide_auction_bid text-left">
                            <p class="auction_bid_text">Maximum bid : <span class="item_size">{{$item->price}} ETH </span></p>
                            <p class="auction_bid_text">Number of auctions : <span class="item_size">1</span></p>
                            <p class="auction_bid_text">View : <span class="item_size">{{$item->view}}</span></p>
                            <p class="auction_bid_text">Auction start date : <span class="item_size">{{$item->begin_date}}</span></p>
                        </div>
                        <div class="nft_product_link slide_auction_bottom pt-20 pb-10"><!-- start product link -->					
                            <ul>
                                <li class="product-all-icon">
                                    <span class="item-history product-icon">											
                                        <a href="#" class="item-history-btn" data-toggle="modal" data-target="#popup_history">
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
                            <span class="place-bid-slider btn-item-details"><!-- start place bid -->
                                <a href="#" class="placebid slider-bid price" data-toggle="modal" data-target="#popup_bid">Bid Now</a>
                            </span><!-- end place bid -->							
                        </div><!-- end product link -->								
                    </div><!-- end slide text area -->									
                </div><!-- end col -->		
                <div class="col-md-7 col-sm-12"><!-- start col -->	
                    <div class="slider_img_area item-details-area wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="jumbotron countdown slide-countdown show" data-Date='{{$item->end_date}}' data-endText="Auction ended">					
                            <div class="running">
                                <span class="timer slide">
                                  <span class="days"> </span> : Ds
                                  <span class="hours"> </span> : Hs
                                  <span class="minutes"> </span> : Ms
                                  <span class="seconds"> </span> : Ss
                                  </span>							  
                            </div>
                        </div> <!-- end count down -->						
                        <div class="slider_img">
                            <img src="{{ asset('uploads/item/'.$item->image) }}" alt="" class="responsive-fluid" />
                        </div>
                    </div>
                </div><!-- end col -->							
            </div><!-- end row -->	
        </div><!-- end single slide -->		
    </div><!-- end container -->	
</section><!-- end product slider area -->	

<div id="how-works" class="how-work-area pt-100 pb-80"><!-- start how work -->		
    <div class="container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-3 col-sm-6 mb-20"><!-- start col-3 -->
                <div class="single_feature_are how-one text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="why_icon">
                        <i class='bx bx-wallet-alt'></i>
                    </div>
                    <div class="why_text">
                        <h6 class="why_title">Connect your Wallet</h6>
                    </div>
                </div>
            </div><!-- end col-3 -->
            <div class="col-md-3 col-sm-6 mb-20"><!-- start col-3 -->
                <div class="single_feature_are how-two text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                    <div class="why_icon">
                        <i class='bx bx-notepad'></i>
                    </div>
                    <div class="why_text">
                        <h6 class="why_title">Create a Collection</h6>
                    </div>
                </div>
            </div><!-- end col-3 -->
            <div class="col-md-3 col-sm-6 mb-20"><!-- start col-3 -->
                <div class="single_feature_are how-three text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                    <div class="why_icon">
                        <i class='bx bx-pyramid'></i>
                    </div>
                    <div class="why_text">
                        <h6 class="why_title">Add NFT Products</h6>
                    </div>
                </div>
            </div><!-- end col-3 -->
            <div class="col-md-3 col-sm-6 mb-20"><!-- start col-3 -->
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