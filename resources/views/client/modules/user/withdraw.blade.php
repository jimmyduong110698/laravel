@extends('client.master')

@push('css')
    <style>
        .note {
            float: left;
            margin-left: 20.68px;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .nice-select.wide {
            border: 1px solid var(--light-color) !important;
            margin-left: 14.68px;
            border-radius: 50px;
            padding-left: 25px;
        }
        .account_input  {
            padding-right: 0;
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
                        <h2 class="account_form_title span-color"> Withdraw ETH</h2>
                        <div class="share-btn social-profile"><!-- start profile btn -->
                        </div><!-- end profile btn -->					
                    </div>
                    <h5>How much ETH you want to withdaw?</h5>
                    <div class="container">
                        <div class="row mt-5"><!-- start row -->
                            <div class="col-md-12">
                                <div class="account_form_area text-center">
                                    <form id="account-form" action="{{route('client.withdraw_store')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group account_input col-md-12 pb-10">
                                                <input type="number" name="withdraw_eth" class="form-control account_style" id="recharge" placeholder="ETH" required>
                                            </div>
                                            <select class="wide mb-2" name="bank">
                                                <option value="NCB">NCB</option>
                                                <option value="ACB">ACB</option> 
                                                <option value="OCB">OCB</option> 
                                            </select>
                                            <div class="form-group account_input col-md-12 pb-10" style="margin-top: 16px">
                                                <input type="number" name="account_number" class="form-control account_style" id="recharge" placeholder="Account number" required>
                                            </div>	
                                            <div class="form-group account_input col-md-12 pb-10">
                                                <input type="text" name="account_name" class="form-control account_style" style="margin: 0" placeholder="Account name" required>
                                            </div>	
                                            @if ($errors->any())
                                            <div class="show-error">
                                                @foreach ($errors->all() as $error)
                                                    <h5 style="margin-left: 25px;color: #e74c3c; text-align: left;">{{ $error }}</h5>
                                                @endforeach
                                            </div>
                                            @endif
                                            <div class="form-group account_input col-md-12 pb-10" id="eth-to-vnd">
                                                <h5>VND</h5>
                                            </div>			
                                            <div class="note">
                                                <p>* 1 ETH = 9.800 VND</p>
                                            </div>						
                                            <div class="col-md-12">
                                                <div class="actions pt-30">
                                                    <input type="submit" value="Withdraw now" name="withdraw"
                                                    id="withdrawButton" class="btn btn-account btn-contact-bg" title="Withdraw ETH!">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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