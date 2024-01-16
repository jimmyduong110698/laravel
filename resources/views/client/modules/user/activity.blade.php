@extends('client.master')

@section('content')
<div id="hero-slider-area" class="header-hero-area site-breadcrumb-header fix"> <!-- start header banner -->

    <!-- Start Breadcrumb
    ============================================= -->
    <div class="site-breadcrumb pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-200 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="breadcrumb-title">All Activity</h2>
                    <ul class="breadcrumb-menu clearfix">
                        <li>
                            <a href="index.html">Home / </a> <a href="#" class="active">Activity</a>
                        </li>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->	

<section class="tab-area-white">
    <div class="activity-area pb-100" id="activity">	<!-- start activity -->	
        <div class="container">
           <div class="row items">
                <div class="col-md-9 col-sm-12 pt-100">	<!-- start col-8 -->
                    <div class="macaw-tabs macaw-elegant-tabs"><!-- start macaw tabs -->
                        <div role="tablist" aria-label="Resources"><!-- start tablist -->
                            <button role="tab" aria-selected="true" aria-controls="all-tab" id="all">
                                <span class="label"><i class='bx bx-clipboard' ></i> All</span>
                            </button>
                            <button role="tab" aria-selected="false" aria-controls="purchage-tab" id="purchage" tabindex="-1">
                                <span class="label"><i class='bx bx-shopping-bag' ></i> Purchage</span>
                            </button>
                            <button role="tab" aria-selected="false" aria-controls="following-tab" id="following" tabindex="-1">
                                <span class="label"><i class='bx bxs-user-check' ></i> Following</span>
                            </button>
                            <button role="tab" aria-selected="false" aria-controls="liked-tab" id="liked" tabindex="-1">
                                <span class="label"><i class='bx bxs-heart'></i>  Likes</span>
                            </button>
                            <button role="tab" aria-selected="false" aria-controls="bids-tab" id="bids" tabindex="-1">
                                <span class="label"><i class='bx bx-bitcoin'></i> Bids</span>
                            </button>
                        </div><!-- end tablist -->
                        <div tabindex="0" role="tabpanel" aria-labelledby="all" id="all-tab">
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/11.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Human Machanism Picture <span class="purchage_spanbtn"><i class='bx bx-shopping-bag' ></i></span></a>
                                    <p class="purchage-value">Total Value : <span class="eth-counter">450 ETH</span></p>										
                                    <p class="purchage-text">
                                        Purchased by 
                                        <a href="author-details.html" class="author-link">@Devid Wane</a> for 0.01 ETH 2 hours ago
                                    </p>
                                </div>
                            </div> <!-- end tab item -->
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/1.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Wane O brain <span class="purchage_spanbtn"><i class='bx bxs-user-check' ></i></span></a>
                                    <p class="purchage-text">
                                        started following
                                        <a href="author-details.html" class="author-link">@Max Doe</a> 4 hours ago
                                    </p>										
                                    <p class="purchage-value">Total Spent : <span class="eth-counter">3.5 ETH</span></p>										
                                </div>
                            </div> <!-- end tab item -->
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/2.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Robotic Body Art<span class="purchage_spanbtn"><i class='bx bx-shopping-bag' ></i></span></a>
                                    <p class="purchage-value">Total Value : <span class="eth-counter">45 ETH</span></p>										
                                    <p class="purchage-text">
                                        1 part purchased by 
                                        <a href="author-details.html" class="author-link">@Max Doe</a> for 0.01 ETH 8 hours ago
                                    </p>
                                </div>
                            </div> <!-- end tab item -->
                        </div> <!-- end tab panel -->
                        <div tabindex="0" role="tabpanel" aria-labelledby="purchage" id="purchage-tab" hidden>
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/3.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Human Machanism Picture<span class="purchage_spanbtn"><i class='bx bx-shopping-bag' ></i></span></a>
                                    <p class="purchage-value">Total Value : <span class="eth-counter">450 ETH</span></p>										
                                    <p class="purchage-text">
                                        Purchased by 
                                        <a href="author-details.html" class="author-link">@Devid Wane</a> for 0.01 ETH 2 hours ago
                                    </p>
                                </div>
                            </div> <!-- end tab item -->
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/4.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Robotic 3D Art Collection <span class="purchage_spanbtn"><i class='bx bx-shopping-bag' ></i></span> </a>
                                    <p class="purchage-value">Total Value : <span class="eth-counter">42 ETH</span></p>										
                                    <p class="purchage-text">
                                        1 part purchased by 
                                        <a href="author-details.html" class="author-link">@William</a> for 0.01 ETH 4 hours ago
                                    </p>
                                </div>
                            </div> <!-- end tab item -->
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/5.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Female Art Face <span class="purchage_spanbtn"><i class='bx bx-shopping-bag' ></i></span></a>
                                    <p class="purchage-value">Total Value : <span class="eth-counter">49 ETH</span></p>										
                                    <p class="purchage-text">
                                        1 part purchased by 
                                        <a href="author-details.html" class="author-link">@Max Doe</a> for 0.01 ETH 7 hours ago
                                    </p>
                                </div>
                            </div> <!-- end tab item -->
                        </div> <!-- end tab panel -->
                        <div tabindex="0" role="tabpanel" aria-labelledby="following" id="following-tab" hidden>
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/6.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Wane O brain <span class="purchage_spanbtn"><i class='bx bxs-user-check' ></i></span></a>
                                    <p class="purchage-text">
                                        started following
                                        <a href="author-details.html" class="author-link">@Max Doe</a> 4 hours ago
                                    </p>										
                                    <p class="purchage-value">Total Spent : <span class="eth-counter">3.5 ETH</span></p>										
                                </div>
                            </div> <!-- end tab item -->
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/5.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Devid Koma <span class="purchage_spanbtn"><i class='bx bxs-user-check' ></i></span></a>
                                    <p class="purchage-text">
                                        started following
                                        <a href="author-details.html" class="author-link">@Jonathon Doe</a> 5 hours ago
                                    </p>										
                                    <p class="purchage-value">Total Spent : <span class="eth-counter">1.5 ETH</span></p>										
                                </div>
                            </div> <!-- end tab item -->
                        </div> <!-- end tab panel -->
                        <div tabindex="0" role="tabpanel" aria-labelledby="liked" id="liked-tab" hidden>
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/4.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Wane O brain <span class="purchage_spanbtn"><i class='bx bx-heart'></i></span></a>
                                    <p class="purchage-text">
                                        Liked
                                        <a href="item-details.html" class="author-link">3D Animation Art</a> 4 hours ago
                                    </p>										
                                    <p class="purchage-value">Total Spent : <span class="eth-counter">3.5 ETH</span></p>										
                                </div>
                            </div> <!-- end tab item -->
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/3.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Devid Koma <span class="purchage_spanbtn"><i class='bx bx-heart'></i></span></a>
                                    <p class="purchage-text">
                                        liked
                                        <a href="author-details.html" class="author-link">Digtal Art Collection V2</a> 5 hours ago
                                    </p>										
                                    <p class="purchage-value">Total Spent : <span class="eth-counter">1.5 ETH</span></p>										
                                </div>
                            </div> <!-- end tab item -->
                        </div> <!-- end tab panel -->
                        <div tabindex="0" role="tabpanel" aria-labelledby="bids" id="bids-tab" hidden>
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/2.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Wane O brain <span class="purchage_spanbtn"><i class='bx bx-bitcoin'></i></span></a>
                                    <p class="purchage-text">
                                        Bids to
                                        <a href="item-details.html" class="author-link">Virtual 3D Game Collection</a> 4 hours ago
                                    </p>										
                                    <p class="purchage-value">Total Spent : <span class="eth-counter">3.5 ETH</span></p>										
                                </div>
                            </div> <!-- end tab item -->
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/1.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">Devid Koma <span class="purchage_spanbtn"><i class='bx bx-bitcoin'></i></span></a>
                                    <p class="purchage-text">
                                        Bids to
                                        <a href="item-details.html" class="author-link">Virtual 3D Game Collection</a> 5 hours ago
                                    </p>										
                                    <p class="purchage-value">Total Spent : <span class="eth-counter">1.5 ETH</span></p>										
                                </div>
                            </div> <!-- end tab item -->
                        </div> <!-- end tab panel -->
                    </div>	<!-- end macaw tabs -->				
                </div>	<!-- end col- -->
                <div class="col-md-3 col-sm-12 pt-100">	<!-- start col -->
                    <div class="tags-area">
                        <div class="tags-title">
                            <h4 class="tags-heading">Filtter by Tags</h4>
                        </div>
                        <div class="widget-content pt-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="widget-content filter-widget-items mt-3">
                                <a href="#." class="badge tag">Live Auction</a>
                                <a href="#." class="badge tag">Purchase</a>
                                <a href="#." class="badge tag">Transfer</a>
                                <a href="#." class="badge tag">Sales</a>
                                <a href="#." class="badge tag">Activity</a>
                                <a href="#." class="badge tag">Followings</a>
                            </div>
                        </div>
                    </div>
                </div>	<!-- end col -->
            </div>	<!-- end row -->
        </div>	<!-- end container -->
    </div>	<!-- End  Activity -->		
</section>	<!-- end tab area white -->   
@endsection