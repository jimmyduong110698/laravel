@extends('client.master')

@section('content')
<div id="hero-slider-area" class="header-hero-area site-breadcrumb-header fix"> <!-- start header banner -->

    <!-- Start Breadcrumb
    ============================================= -->
    <div class="site-breadcrumb pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-200 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <h2 class="breadcrumb-title">Register Now</h2>
                    <ul class="breadcrumb-menu clearfix">
                        <li>
                            <a href="index.html">Home /</a> <a href="#" class="active">Signup</a>
                        </li>
                    </ul>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->			

<section class="signin_area pt-100 pb-30"><!-- start sign in area -->	
    <div class="container"><!-- start container -->	
        <div class="acount_form_bg text-center wow fadeInRight" data-wow-duration="1s" data-wow-delay=".6s" style="visibility: visible; animation-duration: 0.4s; animation-delay: 0.4s;">
            <div class="form-title pt-30">
                <h2 class="account_form_title span-color"> Register Now</h2>				
            </div>
            <div class="row"><!-- start row -->
                <div class="col-md-12">
                    <div class="account_form_area text-center">
                        <form id="account-form" style="margin: 0 auto;box-sizing: border-box" action="{{route('client.create_user')}}" method="post">
                            @csrf
                            <div class="row" style="width: 100%">
                                <div class="form-group account_input col-md-6">
                                    <input type="email" style="margin-bottom: 20px" name="email" value="{{ old('email') }}" class="form-control account_style" id="email" placeholder="Your email" required="required">
                                    <input type="text" style="margin-bottom: 20px" name="full_name" value="{{ old('full_name') }}" class="form-control account_style" id="full_name" placeholder="Your full name" required="required">
                                    <input type="text" style="margin-bottom: 20px" name="nick_name" value="{{ old('nick_name') }}" class="form-control account_style" id="nick_name" placeholder="Your nick name" required="required">
                                    <fieldset data-role="controlgroup" style="margin-left: 48px;margin-bottom: 20px">
                                        <div class="row" style="align-items: center">
                                            <h6>Choose your gender:</h6>
                                            <label style="margin: 0 20px" for="male">Male</label>
                                            <input type="radio" name="gender" id="male" value="1" @php
                                                echo old('gender')==1 || old('gender')==null ? "checked" : "";
                                            @endphp>
                                            <label style="margin: 0 20px" for="female">Female</label>
                                            <input type="radio" name="gender" id="female" value="2" @php
                                                echo old('gender')==2 ? "checked" : "";
                                            @endphp>
                                        </div>
                                    </fieldset>
                                    <input type="password" style="margin-bottom: 20px" name="password" class="form-control account_style" id="password" placeholder="Password" required="required">
                                    <input type="password" style="margin-bottom: 20px" name="password_confirmation" class="form-control account_style" id="password_confirmation" placeholder="Confirm password" required="required">
                                </div>
                                <div class="form-group account_input col-md-6">
                                    <input type="text" style="margin-bottom: 20px" name="citizen_id" value="{{ old('citizen_id') }}" class="form-control account_style" id="citizen_id" placeholder="Your citizen id" required="required">
                                    <input type="text" style="margin-bottom: 20px" name="phone" value="{{ old('phone') }}" class="form-control account_style" id="phone" placeholder="Your phone number" required="required">
                                    <input type="text" style="margin-bottom: 20px" name="addresss" value="{{ old('addresss') }}" class="form-control account_style" id="addresss" placeholder="Your addresss" required="required">
                                    <input type="date" max="2005-12-31" style="margin-bottom: 20px; margin-left: 20px" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control account_style" id="date_of_birth" placeholder="Your date of birth">
                                    <textarea style="margin-left: 20px" class="form-control edit-form-control" name="content" id="descriptionup" placeholder="Bio area...." required>{{ old('content') }}</textarea>
                                </div>	
                                @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <p style="padding-left: 42px">* {{ $error }}!</p>
                                @endforeach
                                @endif				
                                <div class="col-md-12">
                                    <div class="actions pt-20">
                                        <input type="submit" value="Sign Up" name="submit" id="submitButton" class="btn btn-account btn-contact-bg" title="Submit Your Message!">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                          
                </div>
                <div class="col-md-12">
                    <div class="account-alternative">
                        <p class="account_alter_text">Already have an account?  <a href="/login"> Log in!</a></p>
                    </div>
                </div>
            </div><!-- end row -->					
        </div><!-- end account form bg -->	
    </div><!-- end container -->	
</section><!-- end sign in area -->	
@endsection