@extends('client.master')

@section('content')
<section class="signin_area pt-100 pb-30"><!-- start sign in area -->	
    <div class="container"><!-- start container -->		
        <div class="row justify-content-center"><!-- start row -->			
            <div class="col-md-6"><!-- start col-6 -->
                <div class="acount_form_bg text-center wow fadeInRight" data-wow-duration="1s" data-wow-delay=".6s" style="visibility: visible; animation-duration: 0.4s; animation-delay: 0.4s;"> 
                    <div class="form-title pt-30">
                        <h2 class="account_form_title span-color">Thank you for your purchase</h2>
                        <div class="share-btn social-profile"><!-- start profile btn -->
                        </div><!-- end profile btn -->					
                    </div>
                    <div class="container">
                        <div class="row mt-5"><!-- start row -->
                            <div class="col-md-12">
                                <div class="account_form_area">
                                    <div class="row justify-content-center ml-2">
                                        <div class="col-md-6 text-left">
                                            <h5>Bill code: </h5>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <p>
                                                {{$_GET['vnp_TxnRef']}}
                                            </p>
                                        </div>   
                                    </div>
                                    <div class="row justify-content-center ml-2">
                                        <div class="col-md-6 text-left">
                                            <h5>ETH recharge: </h5>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <p>
                                             {{$_GET['vnp_Amount']}}
                                            </p>
                                        </div>   
                                    </div>
                                </div>                          
                            </div>
                        </div><!-- end row -->	
                    </div>				
                </div><!-- end account form bg -->
            </div><!-- end col-6 -->				
        </div><!-- start row -->			
    </div><!-- end container -->	
</section><!-- end sign in area -->	


@endsection