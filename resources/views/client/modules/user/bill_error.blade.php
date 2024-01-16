@extends('client.master')

@push('css')
    <style>
        .btn-try {
            background: var(--btnbg-color) !important;
            border-radius: 0.5rem;
            position: relative;
            color: var(--light-color) !important;
            font-weight: 500;
            padding: 12px 90px;
        }
        @media (max-width: 400px) {
            .btn-try {
                padding: 12px 35px;
            }
        }
    </style>
@endpush
@section('content')
<section class="signin_area pt-100 pb-30"><!-- start sign in area -->	
    <div class="container"><!-- start container -->		
        <div class="row justify-content-center"><!-- start row -->			
            <div class="col-md-6"><!-- start col-6 -->
                <div class="acount_form_bg text-center wow fadeInRight" data-wow-duration="1s" data-wow-delay=".6s" style="visibility: visible; animation-duration: 0.4s; animation-delay: 0.4s;"> 
                    <div class="form-title pt-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M16.707 2.293A.996.996 0 0 0 16 2H8a.996.996 0 0 0-.707.293l-5 5A.996.996 0 0 0 2 8v8c0 .266.105.52.293.707l5 5A.996.996 0 0 0 8 22h8c.266 0 .52-.105.707-.293l5-5A.996.996 0 0 0 22 16V8a.996.996 0 0 0-.293-.707l-5-5zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        <h2 class="account_form_title span-color">Purchase failed!!!</h2>
                        <div class="share-btn social-profile"><!-- start profile btn -->
                        </div><!-- end profile btn -->					
                    </div>
                    <div class="container">
                        <div class="row mt-5 mb-5"><!-- start row -->
                            <div class="col-md-12">
                                <a href="{{route('client.recharge')}}" class="btn-try">Try again</a>    
                            </div>
                        </div><!-- end row -->	
                    </div>				
                </div><!-- end account form bg -->
            </div><!-- end col-6 -->				
        </div><!-- start row -->			
    </div><!-- end container -->	
</section><!-- end sign in area -->	


@endsection