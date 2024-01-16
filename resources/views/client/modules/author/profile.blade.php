@extends('client.master')

@section('content')
<div id="hero-slider-area" class="header-hero-area site-breadcrumb-header fix"> <!-- start header banner -->

    <!-- Start Breadcrumb
    ============================================= -->
    <div class="site-breadcrumb pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-200 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="breadcrumb-title">Author Details</h2>
                    <ul class="breadcrumb-menu clearfix">
                        <li>
                            <a href="index.html">Home /</a> <a href="#" class="active"> author /</a> <a href="#" class="active"> {{$author->nick_name}}</a>
                        </li>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->	

<!-- Start Modal Popup -->	

<div class="modal fade popup" id="popup_share" tabindex="-1" role="dialog" aria-hidden="true"><!-- start share btn popup -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3>Share with : </h3>
                <div class="share-btn"><!-- start place btn -->
                    <ul class="share-icon-list">
                        <li class="nav-item">
                            <a href="#" class="share-icon1"><i class='bx bxl-facebook' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon2"><i class='bx bxl-linkedin' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon3"><i class='bx bxl-twitter' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon4"><i class='bx bxl-pinterest-alt' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon5"><i class='bx bxl-google-plus' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon6"><i class='bx bxl-instagram' ></i></a>
                        </li>
                    </ul>
                </div><!-- end share btn -->
            </div><!-- end modal body -->
        </div><!-- end modal content -->
    </div><!-- end modal dialog -->
</div><!-- end  share btn popup -->	
<div class="modal fade popup" id="popup_report_success" tabindex="-1" role="dialog" aria-hidden="true"><!-- start report successful -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3 class="text-center">Your Report Successfuly Counted</h3>
                <p class="text-center">We will have taken against this item after reviewing. Thanks for your support.</p>
                <a href=" " class="btn btn-dark"> Watch More</a>
            </div>
        </div>
    </div>
</div><!-- end report successful -->
<div class="modal fade popup" id="popup_report" tabindex="-1" role="dialog" aria-hidden="true"><!-- start report input popup -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3>Copyright Claim Against :</h3>
                <div class="input-field-form">
                    <input type="text" class="form-control" placeholder="Explain behind the reason">			
                </div>
                <div class="hr"></div>
                <div class="place-bid-btn"><!-- start place btn -->
                    <a href="#" class="btn btn-primary w-full popup-bid-btn" 
                        data-toggle="modal" data-target="#popup_report_success" 
                        data-dismiss="modal" aria-label="Close"> Submit Report
                    </a>					
                </div><!-- end place btn -->
            </div><!-- end modal body -->
        </div><!-- end modal content -->
    </div><!-- end modal dialog -->
</div><!-- end report input popup -->	
<div class="modal fade popup" id="popup_bid_success" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid successful -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3 class="text-center">Your Bid Successfuly Added</h3>
                <p class="text-center">Your bid <span class="color_text txt_bold">(5.511 ETH) </span> has been counted.</p>
                <a href=" " class="btn btn-dark"> Watch More</a>
            </div>
        </div>
    </div>
</div><!-- end bid successful -->
<div class="modal fade popup" id="popup_bid" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid input popup -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3>Place a Bid</h3>
                <div class="d-flex justify-content-between">
                    <p> service fee : </p>
                    <p class="text-right color_black txt _bold"> .511 ETH </p>
                </div>
                <div class="d-flex justify-content-between last-child-bid">
                    <p> You must bid at least : </p>
                    <p class="text-right color_black txt _bold"> 5.00 ETH</p>
                </div>
                <div class="input-field-form">
                    <input type="text" class="form-control" placeholder=" 5.00 ETH / UNIT">
                    <p class="enter-quantity">Unit Quantity. <span class="offline-color">26 available</span></p>		
                </div>
                <div class="hr"></div>
                <div class="d-flex justify-content-between">
                    <p> Total bid amount : </p>
                    <p class="text-right color_black txt _bold"> 5.511 ETH </p>
                </div>
                <div class="place-bid-btn"><!-- start place btn -->
                    <a href="#" class="btn btn-primary w-full popup-bid-btn" 
                        data-toggle="modal" data-target="#popup_bid_success" 
                        data-dismiss="modal" aria-label="Close"> Place bid
                    </a>					
                </div><!-- end place btn -->
            </div><!-- end modal body -->
        </div><!-- end modal content -->
    </div><!-- end modal dialog -->
</div><!-- end bid input popup -->
<div class="modal fade popup" id="popup_history" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid history -->
    <div class="modal-dialog modal-dialog-centered" role="document"><!-- start modal-dialog -->
        <div class="modal-content"><!-- start modal-content -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40"><!-- start modal-body -->
                
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end bid history -->	

<!-- End Modal Popup -->	

<section class="author-details dark-bg-all pt-90 pb-80"><!-- start author details area -->
    <div class="container author-details-container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-5"><!-- start col -->
                <div class="author-details-top pb-50">
                    <div class="author-details-img">
                        <img src="{{ asset('client/img/avatar/'.rand(1,12).'.jpg') }}" alt="" class="responsive-fluid" />
                        <div class="author-icon">
                            <i class="bx bxs-check-circle"></i>
                        </div>
                    </div>
                    <div class="author-text-link" style="margin-left: 100px">
                        <h6 class="author_name">{{$author->nick_name}}</h6>
                        <div class="follower-btn-counter">
                            <a href="#" class="follower-btn">Follow </a>
                            <span class="followers-count">540</span>							
                        </div>
                    </div>
                </div>			
            </div><!-- end col -->
            <div class="col-md-7"><!-- start col -->
                <div class="about-me"> <!-- tab item -->
                    <div class="about-me-text-link">
                        <h6 class="about-heading">Author Brief</h6>
                        <p>I make classical literature, discovered the undoubtable source art with the simple goal of giving you something 
                        pleasing to look at. </p>
                    </div>
                    <div class="share-btn social-profile"><!-- start share btn -->
                        <ul class="share-icon-list social-list">
                            <li class="nav-item">
                                <a href="#" class="share-icon1"><i class="bx bxl-facebook"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="share-icon2"><i class="bx bxl-linkedin"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="share-icon3"><i class="bx bxl-twitter"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="share-icon6"><i class="bx bxl-instagram"></i></a>
                            </li>
                        </ul>
                    </div><!-- start share btn -->						
                </div> <!-- end tab item -->					
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="container macaw-tabs-container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-12 col-sm-12 pt-50">	<!-- start col-10 -->
                <div class="macaw-tabs macaw-elegant-tabs"><!-- start macaw tabs -->
                    <div role="tablist" aria-label="Resources"><!-- start tablist -->
                        <button role="tab" aria-selected="true" aria-controls="notification-tab" id="notification">
                            <span class="label"><i class='bx bxs-notification'></i> Comment</span>
                        </button>
                        <button role="tab" aria-selected="false" aria-controls="auction-tab" id="auction" tabindex="-1">
                            <span class="label"><i class='bx bx-shopping-bag' ></i> Item on Sale</span>
                        </button>
                    </div><!-- end tablist -->
                    <div tabindex="0" role="tabpanel" aria-labelledby="notification" id="notification-tab"><!-- start tab panel -->
                        <div class="tab-area-bg pb-50"> <!-- start tab area-->
                            @if (count($comments)==0)
                            <h2 style="text-align: center;padding-top: 70px;">No Item</h2>
                            @else
                                @foreach ($comments as $comment)
                                <div class="tab-puchage"> <!-- tab item -->
                                    <div class="tab-purchage-img">
                                        <a href="item-details.html">
                                            <img src="{{ asset('client/img/avatar/'.rand(1,12).'.jpg') }}" alt="author" class="responsive-fluid" />
                                        </a>
                                    </div>
                                    <div class="purchage-text-link">
                                        <a class="puchage-tilte" href="#">{{$comment->content}}</a>										
                                        <p class="purchage-text">
                                            Comment by 
                                            <a href="author-details.html" class="author-link">{{$comment->nick_name}}</a>
                                        </p>
                                    </div>
                                </div> <!-- end tab item -->
                                @endforeach
                            @endif
                        </div> <!-- end tab area-->
                    </div> <!-- end tab panel -->
                    <div tabindex="0" role="tabpanel" aria-labelledby="auction" id="auction-tab" hidden><!-- start tab panel -->
                        <div class="sale-item tab-area-bg"> <!-- start tab area -->
                            <div class="row"> <!-- start row -->
                                @if (count($items)==0)
                                <div class="col-sm-12"><!-- start col-4 -->
                                    <div class="single_product"> <!-- Single Product -->
                                        <h2 style="text-align: center;padding-top: 70px;">No comment</h2>					
                                    </div><!-- end Single Product -->
                                </div> <!-- End col-4 -->	
                                @else
                                    @foreach ($items as $item)
                                    <div class="col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s"><!-- start col-4 -->
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
                                                <span class="thumbsup">9.3k</span>
                                            </div> <!-- end thumbsup rating -->						
                                            <div class="single_product_img"><!-- start single product img -->						
                                                <a href="https://www.themetum.com/tf/etherino/etherino-light/product.html" class="theme_preview_link">
                                                    <img src="{{ asset('client/img/items/1.jpg') }}" alt="" class="responsive-fluid" />						
                                                </a>
                                            </div> <!-- End single product img -->
                                            <div class="nft_product_description"><!-- start product description -->
                                                <div class="nft_product_text">				
                                                    <ul class="author-profile-link"><!-- start author-->														
                                                        <li class="nav-item">									
                                                            <a href="author-details.html" class="author_link">
                                                                <img src="{{ asset('client/img/avatar/'.rand(1,12).'.jpg') }}" alt="author" class="responsive-fluid img-2" />
                                                                <i class='bx bxs-check-circle'></i>
                                                            </a>	
                                                            <span class="hover_author_link">
                                                                <a href="author-details.html" class="author_link_text">@ {{$item->nick_name}}</a>
                                                            </span>								
                                                        </li>
                                                    </ul>	
                                                </div><!-- end author-->																		
                                                <div class="product_title_link"><!-- start product title-->			
                                                    <a class="product-title" href="#">
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
                                                                    <span class="sale-counter">Unit : {{$item->price}} ETH</span>	
                                                            </span>	
                                                        </li>										
                                                </ul>
                                            </div><!-- end product link -->		
                                            <div class="place-bid"><!-- start place bid -->
                                                <a href="#" class="placebid price" data-toggle="modal" data-target="#popup_bid">Bid Now</a>
                                            </div><!-- end place bid -->						
                                        </div><!-- end Single Product -->
                                    </div> <!-- End col-4 -->	
                                    @endforeach
                                @endif			
                            </div> <!-- End row -->
                        </div> <!-- End tab area -->
                    </div> <!-- end tab panel -->
                </div><!-- end macaw tabs -->				
            </div> <!-- end col-8 -->		
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end author details area --> 
@endsection