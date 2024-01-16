@extends('client.master')

@section('content')
<div id="hero-slider-area" class="header-hero-area site-breadcrumb-header fix"> <!-- start header banner -->

    <!-- Start Breadcrumb
    ============================================= -->
    <div class="site-breadcrumb pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-200 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="breadcrumb-title">News & Press</h2>
                    <ul class="breadcrumb-menu clearfix">
                        <li>
                            <a href="index.html">Home /</a> <a href="#" class="active">Blog</a>
                        </li>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->

<div id="blog_area" class="dark-bg-all pb-50 pt-50"><!-- start blog area -->
    <div class="container pb-30"><!-- start container-->
        <div class="row"><!-- start row -->
            <div class="col-md-3 animate-box pt-50"><!-- col-3 -->
                <div class="blog-sidebar row"><!-- sidebar right -->
                    <div class="col-md-12"><!-- col-12 -->
                        <div class="widget search">
                            <form>
                                <input type="text" name="search" placeholder="Type here ...">
                                <button type="submit"><i class='bx bx-search'></i></button>
                            </form>
                        </div>
                    </div><!-- end col-12 -->
                    <div class="col-md-12"><!-- col-12 -->
                        <div class="widget">
                            <div class="widget-title">
                                <h6>Recent Posts</h6> </div>
                            <ul class="recent">
                                <li>
                                    <a href="#">Best Digital NFTs Marketplace Template</a> </li>
                                <li>
                                    <a href="#">#1 Woocommerce Marketplace Theme</a> </li>
                                <li>
                                    <a href="#">How to make a website like etherino</a> </li>
                            </ul>
                        </div>
                    </div><!-- end col-12 -->
                    <div class="col-md-12"><!-- col-12 -->
                        <div class="widget">
                            <div class="widget-title">
                                <h6>Archives</h6> </div>
                            <ul>
                                <li><a href="#">June 2022</a></li>
                                <li><a href="#">July 2022</a></li>
                                <li><a href="#">August 2022</a></li>
                            </ul>
                        </div>
                    </div><!-- end col-12 -->
                    <div class="col-md-12"><!-- col-12 -->
                        <div class="widget">
                            <div class="widget-title">
                                <h6>Categories</h6> </div>
                            <ul>
                                <li><a href="https://www.themetum.com/tf/etherino/etherino-light/post.html"><i class="ti-angle-right"></i>Graphics</a></li>
                                <li><a href="https://www.themetum.com/tf/etherino/etherino-light/post.html"><i class="ti-angle-right"></i>Domain names</a></li>
                                <li><a href="https://www.themetum.com/tf/etherino/etherino-light/post.html"><i class="ti-angle-right"></i>Arts</a></li>
                                <li><a href="https://www.themetum.com/tf/etherino/etherino-light/post.html"><i class="ti-angle-right"></i>Pictures</a></li>
                                <li><a href="https://www.themetum.com/tf/etherino/etherino-light/post.html"><i class="ti-angle-right"></i>NFTs</a></li>
                            </ul>
                        </div>
                    </div><!-- end col-12 -->
                    <div class="col-md-12"><!-- col-12 -->
                        <div class="widget">
                            <div class="widget-title">
                                <h6>Tags</h6> </div>
                            <ul class="tags">
                                <li><a href="#">NFTs</a></li>
                                <li><a href="#">Product</a></li>
                                <li><a href="#">graphics</a></li>
                                <li><a href="#">Photo</a></li>
                                <li><a href="#">Antic</a></li>
                                <li><a href="#">Robotic</a></li>
                            </ul>
                        </div>
                    </div><!-- end col-12 -->
                </div><!-- end sidebar right -->
            </div><!-- end col-3 -->			
            <div class="col-md-9"><!-- start col-9 -->
                <div class="row">
                    <div class="col-md-6 pt-50">
                        <div class="blog_post"><!-- single blog post -->
                            <a href="blog-details.html" class="post_img"><img src="{{ asset('client/img/extra/blog/1.jpg') }}" alt="" class="responsive-fluid" /> </a>
                            <div class="post_text">
                                <ul>
                                    <li> <a href="#"><i class='bx bx-calendar-star'></i>15 Feb, 2022</a> </li>
                                    <li> <a href="#"><i class='bx bx-comment-detail' ></i>03 Comments</a> </li>
                                </ul>									
                            </div>							
                            <div class="post_hyperlink">
                                <a href="blog-details.html" class="post_title">
                                    <h4 class="post_title_text">How will you make best NFT store effectively ?</h4>
                                </a>									
                            </div>
                        </div><!-- end single blog post -->
                    </div><!-- end col-6 -->
                    <div class="col-md-6 pt-50">
                        <div class="blog_post"><!-- single blog post -->
                            <a href="blog-details.html" class="post_img"><img src="{{ asset('client/img/extra/blog/2.jpg') }}" alt="" class="responsive-fluid" /> </a>
                            <div class="post_text">
                                <ul>
                                    <li> <a href="#"><i class='bx bx-calendar-star'></i>15 Feb, 2022</a> </li>
                                    <li> <a href="#"><i class='bx bx-comment-detail' ></i>03 Comments</a> </li>
                                </ul>									
                            </div>							
                            <div class="post_hyperlink">
                                <a href="blog-details.html" class="post_title">
                                    <h4 class="post_title_text">How will you make best NFT store effectively ?</h4>
                                </a>									
                            </div>
                        </div><!-- end single blog post -->
                    </div><!-- end col-6 -->
                    <div class="col-md-6 pt-50">
                        <div class="blog_post"><!-- single blog post -->
                            <a href="blog-details.html" class="post_img"><img src="{{ asset('client/img/extra/blog/3.jpg') }}" alt="" class="responsive-fluid" /> </a>
                            <div class="post_text">
                                <ul>
                                    <li> <a href="#"><i class='bx bx-calendar-star'></i>15 Feb, 2022</a> </li>
                                    <li> <a href="#"><i class='bx bx-comment-detail' ></i>03 Comments</a> </li>
                                </ul>									
                            </div>							
                            <div class="post_hyperlink">
                                <a href="blog-details.html" class="post_title">
                                    <h4 class="post_title_text">How will you make best NFT store effectively ?</h4>
                                </a>									
                            </div>
                        </div><!-- end single blog post -->
                    </div><!-- end col-6 -->
                    <div class="col-md-6 pt-50">
                        <div class="blog_post"><!-- single blog post -->
                            <a href="blog-details.html" class="post_img"><img src="{{ asset('client/img/extra/blog/4.jpg') }}" alt="" class="responsive-fluid" /> </a>
                            <div class="post_text">
                                <ul>
                                    <li> <a href="#"><i class='bx bx-calendar-star'></i>15 Feb, 2022</a> </li>
                                    <li> <a href="#"><i class='bx bx-comment-detail' ></i>03 Comments</a> </li>
                                </ul>									
                            </div>							
                            <div class="post_hyperlink">
                                <a href="blog-details.html" class="post_title">
                                    <h4 class="post_title_text">How will you make best NFT store effectively ?</h4>
                                </a>									
                            </div>
                        </div><!-- end single blog post -->
                    </div><!-- end col-6 -->
                    <div class="col-md-6 pt-50">
                        <div class="blog_post"><!-- single blog post -->
                            <a href="blog-details.html" class="post_img"><img src="{{ asset('client/img/extra/blog/5.jpg') }}" alt="" class="responsive-fluid" /> </a>
                            <div class="post_text">
                                <ul>
                                    <li> <a href="#"><i class='bx bx-calendar-star'></i>15 Feb, 2022</a> </li>
                                    <li> <a href="#"><i class='bx bx-comment-detail' ></i>03 Comments</a> </li>
                                </ul>									
                            </div>							
                            <div class="post_hyperlink">
                                <a href="blog-details.html" class="post_title">
                                    <h4 class="post_title_text">How will you make best NFT store effectively ?</h4>
                                </a>									
                            </div>
                        </div><!-- end single blog post -->
                    </div><!-- end col-6 -->
                    <div class="col-md-6 pt-50">
                        <div class="blog_post"><!-- single blog post -->
                            <a href="blog-details.html" class="post_img"><img src="{{ asset('client/img/extra/blog/6.jpg') }}" alt="" class="responsive-fluid" /> </a>
                            <div class="post_text">
                                <ul>
                                    <li> <a href="#"><i class='bx bx-calendar-star'></i>15 Feb, 2022</a> </li>
                                    <li> <a href="#"><i class='bx bx-comment-detail' ></i>03 Comments</a> </li>
                                </ul>									
                            </div>							
                            <div class="post_hyperlink">
                                <a href="blog-details.html" class="post_title">
                                    <h4 class="post_title_text">How will you make best NFT store effectively ?</h4>
                                </a>									
                            </div>
                        </div><!-- end single blog post -->
                    </div><!-- end col-6 -->
                </div><!-- end row -->
                <div class="pagination-area blog-pagination"><!-- pagination -->
                    <ul class="pagination">
                      <li class="page-number"><a href="#"><i class='bx bxs-left-arrow-alt'></i></a></li>						
                      <li class="page-number"><a href="#">1</a></li>
                      <li class="page-number active"><a href="#">2</a></li>
                      <li class="page-number"><a href="#">3</a></li>
                      <li class="page-number"><a href="#"><i class='bx bxs-right-arrow-alt'></i></a></li>
                    </ul>					
                </div><!-- end pagination -->
            </div><!-- end col-9 -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end blog area -->
@endsection