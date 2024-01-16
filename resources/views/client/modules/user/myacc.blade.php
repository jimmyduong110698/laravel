@extends('client.master')

@push('handlejs')
    <script>
        $(document).ready(function () {
            $("#imageUpload").change(function() {
                var file = this.files[0];
                console.log(file);
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#upload_avatar").attr("src", e.target.result)
                }

                reader.readAsDataURL(file)
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
                    <h2 class="breadcrumb-title">My Account</h2>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->	

<section class="author-details dark-bg-all pt-90 pb-80"><!-- start author details area -->
    <div class="container author-details-container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-5"><!-- start col -->
                <div class="author-details-top pb-50">
                    <div class="author-details-img">
                        <img src="{{ asset('uploads/avatar/'.$user->avatar) }}" alt="" class="responsive-fluid" width="100px" height="100px" />
                        <div class="author-icon">
                            <i class="bx bxs-check-circle"></i>
                        </div>
                    </div>
                    <div class="author-text-link">
                        <h6 class="author_name">{{Auth::user()->full_name}}</h6>
                        <div class="follower-btn-counter" style="margin: 0;">
                            <h6 class="followers-count" style="margin: 0">540 followers</h6>							
                        </div>
                    </div>
                </div>			
            </div><!-- end col -->
            <div class="col-md-7"><!-- start col -->
                <div class="about-me"> <!-- tab item -->
                    <div class="about-me-text-link">
                        <h6 class="about-heading">Author Bio</h6>
                        <p>{{$user->content}} </p>
                    </div>			
                </div> <!-- end tab item -->					
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="container macaw-tabs-container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-12 col-sm-12 pt-50">	<!-- start col-10 -->
                <div class="macaw-tabs macaw-elegant-tabs"><!-- start macaw tabs -->
                    <div role="tablist" aria-label="Resources"><!-- start tablist -->
                        <button role="tab" aria-selected="false" aria-controls="notification-tab" id="notification">
                            <span class="label"><i class='bx bxs-notification'></i> Notification</span>
                        </button>
                        <button role="tab" aria-selected="false" aria-controls="auction-tab" id="auction" tabindex="-1">
                            <span class="label"><i class='bx bx-shopping-bag' ></i> Your Item</span>
                        </button>
                        <button role="tab" aria-selected="true" aria-controls="profile-tab" id="profile" tabindex="-1">
                            <span class="label"><i class='bx bx-edit-alt' ></i> Account Info</span>
                        </button>
                        <button role="tab" aria-selected="false" aria-controls="item-on-bid" id="bidding" tabindex="-1">
                            <span class="label"><i class='bx bx-cloud-upload' ></i> Item on bid</span>
                        </button>
                        <button role="tab" aria-selected="false" aria-controls="activity-tab" id="activity" tabindex="-1">
                            <span class="label"><i class='bx bxs-user-plus' ></i> Activities</span>
                        </button>
                    </div><!-- end tablist -->
                    <div tabindex="0" role="tabpanel" aria-labelledby="notification" id="notification-tab" hidden><!-- start tab panel -->
                        <div class="tab-area-bg pb-50"> <!-- start tab area-->
                            @if ($notifications->isNotEmpty())
                            @foreach ($notifications as $notification)
                            <div class="tab-puchage"> <!-- tab item -->
                                <div class="tab-purchage-img">
                                    <a href="item-details.html">
                                        <img src="{{ asset('client/img/avatar/5.jpg') }}" alt="author" class="responsive-fluid" />
                                    </a>
                                </div>
                                <div class="purchage-text-link">
                                    <a class="puchage-tilte" href="#">{{$notification->nick_name}}</a>
                                    <p class="purchage-value">{{$notification->content}}</p>										
                                    <p class="purchage-text">{{$notification->create_date}}</p>
                                </div>
                            </div> <!-- end tab item -->
                            @endforeach	
                            @else
                            <h5 style="text-align: center;padding-top: 50px;">No notification!!!</h5>
                            @endif					
                        </div> <!-- end tab area-->
                    </div> <!-- end tab panel -->
                    <div tabindex="0" role="tabpanel" aria-labelledby="auction" id="auction-tab" hidden><!-- start tab panel -->
                        <div class="sale-item tab-area-bg" style="background: var(--body-bgcolor);"> <!-- start tab area -->
                            @if ($user_item->isEmpty())
                            <div class="title-content text-center pt-5 wide">
                                 <h5>There are no items!!!</h5>
                            </div>
                            @else
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
                                    @foreach ($user_item as $item)
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
                                            <div class="single_product_img"><!-- start single product img -->						
                                                <a href="{{route('client.detail',['id'=>$item->id])}}" class="theme_preview_link">
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
                                                        </li>
                                                        <li class="nav-item">
                                                            <span class="hover_author_link">
                                                                <a href="author-details.html" class="author_link_text">{{$item->nick_name}}</a>
                                                            </span>										
                                                        </li>	
                                                    </ul>	
                                                </div><!-- end author-->																		
                                                <div class="product_title_link"><!-- start product title-->			
                                                    <a class="product-title" href="#">
                                                        <h6 class="product_title_intro">{{$item->name}} {{$item->id}}</h6>	
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
                                            @if ($item->status == 1)
                                            <div class="place-bid">
                                                <span style="padding: 5px 20px; border: 1px solid #333; border-radius: 15px">Active</span>
                                            </div>
                                            @elseif ($item->status == 2)
                                            <div class="place-bid">
                                                <span style="padding: 5px 20px; border: 1px solid #333; border-radius: 15px">Ended</span>
                                            </div>
                                            @elseif ($item->status == 3)
                                            <div class="place-bid">
                                                <span style="padding: 5px 20px; border: 1px solid #333; border-radius: 15px">Pending approval</span>
                                            </div>
                                            @else
                                            <div class="place-bid">
                                                <span style="padding: 5px 20px; border: 1px solid #333; border-radius: 15px">Cancel</span>
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
                            @endif
                        </div> <!-- End tab area -->
                    </div> <!-- end tab panel -->
                    <div tabindex="0" role="tabpanel" aria-labelledby="profile" id="profile-tab"><!-- start tab panel -->
                        <div class="edit-profile tab-area-bg"> <!-- start tab area -->
                            <form id="account-form" style="margin: 0 auto;" action="{{route('client.account_update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row"> <!-- start row -->
                                    <div class="col-md-6 mb-2"> <!-- start col -->
                                        <div class="account-info-edit">
                                            <div class="account-info-title">
                                                <h5 class="subtitle">Account Info</h5>
                                            </div>
                                            <div class="edit-avatar mb-5">
                                                <img id="upload_avatar" src="{{ asset('uploads/avatar/'.$user->avatar) }}" alt="edit avatar" class="responsive-fluid" />
                                                <div class="upload-avatar">
                                                    <a href="#" class="btn-upload-avatar">Upload Photo	</a>
                                                    <input id="imageUpload" type="file" name="avatar">
                                                </div>	
                                            </div>
                                        </div> <!-- end account info -->										
                                    </div> <!-- end col -->	   										
                                </div> <!-- End row -->	
                                <div class="row" style="width: 100%">
                                    <div class="form-group account_input col-md-6">
                                        <input type="email" style="margin-bottom: 20px" name="email" value="{{Auth::user()->email}}" class="form-control account_style" id="email" disabled>
                                        <input type="text" style="margin-bottom: 20px" name="full_name" value="{{ Auth::user()->full_name }}" class="form-control account_style" id="full_name">
                                        <input type="text" style="margin-bottom: 20px" name="nick_name" value="{{ $user->nick_name }}" class="form-control account_style" id="nick_name" placeholder="Your nick name" required="required">
                                       @if ($user->gender == 1)
                                       <fieldset data-role="controlgroup" style="margin-left: 40px;margin-bottom: 20px">
                                        <div class="row" style="align-items: center">
                                            <h6>Choose your gender:</h6>
                                        </div>
                                        <div class="row" style="align-items: center">
                                            <label style="margin: 0 20px 0 0" for="male">Male</label>
                                            <input type="radio" name="gender" id="male" value="1" checked>
                                            <label style="margin: 0 20px" for="female">Female</label>
                                            <input type="radio" name="gender" id="female" value="2">
                                        </div>
                                        </fieldset>
                                       @else
                                       <fieldset data-role="controlgroup" style="margin-left: 40px;margin-bottom: 20px">
                                        <div class="row" style="align-items: center">
                                            <h6>Choose your gender:</h6>
                                        </div>
                                        <div class="row" style="align-items: center">
                                            <label style="margin: 0 20px 0 0" for="male">Male</label>
                                            <input type="radio" name="gender" id="male" value="1">
                                            <label style="margin: 0 20px" for="female">Female</label>
                                            <input type="radio" name="gender" id="female" value="2" checked>
                                        </div>
                                        </fieldset>
                                       @endif
                                        <input type="password" style="margin-bottom: 20px" name="password" class="form-control account_style" id="password" placeholder="Password">
                                        <input type="password" style="margin-bottom: 20px" name="password_confirmation" class="form-control account_style" id="password_confirmation" placeholder="Confirm password">
                                    </div>
                                    <div class="form-group account_input col-md-6">
                                        <input type="text" style="margin-bottom: 20px" name="citizen_id" value="{{ Auth::user()->citizen_id }}" class="form-control account_style" id="citizen_id" disabled>
                                        <input type="text" style="margin-bottom: 20px" name="phone" value="{{ Auth::user()->phone }}" class="form-control account_style" id="phone">
                                        <input type="text" style="margin-bottom: 20px" name="addresss" value="{{ Auth::user()->addresss }}" class="form-control account_style" id="addresss">
                                        <input type="date" value="{{ Auth::user()->date_of_birth }}" max="2010-01-01" style="margin-bottom: 20px; margin-left: 20px" name="date_of_birth" class="form-control account_style" id="date_of_birth">
                                        <textarea style="margin-left: 20px" class="form-control edit-form-control" name="content" id="descriptionup">{{$user->content}}</textarea>
                                    </div>	
                                    @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <p style="padding-left: 42px">* {{ $error }}!</p>
                                    @endforeach
                                    @endif				
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="actions pt-30">
                                        <button type="submit" name="submit" id="submitbtn" class="btn btn-lg btn-contact-bg">
                                            Update Profile
                                        </button>						
                                    </div>
                                </div>
                            </form>							
                        </div> <!-- End tab area -->		
                  </div> <!-- end tab panel -->
                    <div tabindex="0" role="tabpanel" aria-labelledby="bidding" id="item-on-bid" hidden><!-- start tab panel -->
                        <div class="sale-item tab-area-bg"> <!-- start tab area -->
                            @if ($user_item->isEmpty())
                            <div class="title-content text-center pt-5 wide">
                                <h5>There are no items!!!</h5>
                            </div>  
                            @else
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
                            <div class="row"> <!-- start row -->
                                @foreach ($user_item as $item)
                                <div class="col-md-6 col-sm-12 wow fadeInUp" style="border: 2px solid var(--lightgrey-color); border-radius: 10px" data-wow-duration="1s" data-wow-delay=".3s"><!-- start col-4 -->
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
                                                <img src="{{ asset('uploads/item/'.$item->image) }}" alt="" class="responsive-fluid" />						
                                            </a>
                                        </div> <!-- End single product img -->
                                        <div class="nft_product_description"><!-- start product description -->																	
                                            <div class="product_title_link"><!-- start product title-->			
                                                <a class="product-title" href="#">
                                                    <h6 class="product_title_intro">Mystetious Robotic Body Art</h6>	
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
                                                    <span class="sale-count product-icon">
                                                            <span class="sale-counter">Unit : {{$item->price}} ETH</span>	
                                                    </span>	
                                                </li>										
                                            </ul>
                                        </div><!-- end product link -->							
                                    </div><!-- end Single Product -->
                                </div> <!-- End col-4 -->	
                                @endforeach		
                            </div> <!-- End row -->
                            @endif
                        </div> <!-- End tab area -->					
                  </div> <!-- end tab panel -->
                    <div tabindex="0" role="tabpanel" aria-labelledby="activity" id="activity-tab" hidden><!-- start tab panel -->
                        <div class="activity-area tab-area-bg"> <!-- start tab area -->
                            <div class="row"> <!-- start row -->
                                <div class="col-md-12"> <!-- start col -->
                                    <div class="tab-puchage"> <!-- tab item -->
                                        <div class="tab-purchage-img">
                                            <a href="item-details.html">
                                                <img src="{{ asset('client/img/avatar/5.jpg') }}" alt="author" class="responsive-fluid" />
                                            </a>
                                        </div>
                                        <div class="purchage-text-link">
                                            <a class="puchage-tilte" href="#">Digital Art 3D Collection <span class="purchage_spanbtn"><i class='bx bx-shopping-bag' ></i></span></a>
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
                                                <img src="{{ asset('client/img/avatar/7.jpg') }}" alt="author" class="responsive-fluid" />
                                            </a>
                                        </div>
                                        <div class="purchage-text-link">
                                            <a class="puchage-tilte" href="#">Walk in Space<span class="purchage_spanbtn"><i class='bx bx-shopping-bag' ></i></span></a>
                                            <p class="purchage-value">Total Value : <span class="eth-counter">45 ETH</span></p>										
                                            <p class="purchage-text">
                                                1 part purchased by 
                                                <a href="author-details.html" class="author-link">@Max Doe</a> for 0.01 ETH 8 hours ago
                                            </p>
                                        </div>
                                    </div> <!-- end tab item -->												
                                </div> <!-- start col -->								
                            </div> <!-- End row -->							
                        </div> <!-- End tab area -->						
                  </div> <!-- end tab panel -->
                </div><!-- end macaw tabs -->				
            </div> <!-- end col-8 -->		
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end author details area --> 
@endsection

