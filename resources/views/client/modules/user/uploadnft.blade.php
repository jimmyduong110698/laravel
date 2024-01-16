@extends('client.master')

@push('css')
<link rel="stylesheet" href="{{ asset('mylib/css/mobiscroll.jquery.min.css') }}">
    <style>
        .nice-select span {
            position: absolute;
            transform: translate(0,-50%);
        }
        .tran-icon {
            top: 19px;
            left: 15px;
        }
        .btn-upload-avatar-upload {
            background: var(--btnbg-color) !important;
            color: var(--white-color) !important;
            border: none !important;
            padding: 0.6rem 1.2rem;
            border-radius: 4rem;
        }
        .datetime-begin {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    </style>
@endpush
@push('handlejs')
<script src="{{ asset('mylib/js/mobiscroll.jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // const now = new Date();
        // var today = new Date().toISOString().split('T')[0];
        // $('#begin_date').attr('min', today);

        $("#imageUpload").change(function() {
            var file = this.files[0];
            console.log(file);
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#upload_item").attr("href", e.target.result)
            }

            reader.readAsDataURL(file)
        });
    });
    mobiscroll.setOptions({
        theme: 'ios',
        themeVariant: 'light'
    });

    var now = new Date();
    var until = new Date(now.getFullYear(),now.getMonth(),now.getDate(),now.getHours() + 1);
    var old_date = $("input[name='old_date']").val();

    if (old_date != "") {
        old_date = old_date.split("/");
        const day = old_date[0];
        const month = old_date[1];
        old_date = old_date[2].split(" ");
        const year = old_date[0];
        old_date = old_date[1].split(":");
        const hour = old_date[0];
        const minute = old_date[1];
        old_date = year + "-" + month + "-" + day + " " + hour + ":" + minute;

        var check_old = 0;
        $('#date-time-picker').mobiscroll().datepicker({
            controls: ['date', 'time'],
            touchUi: true,
            dateFormat: 'DD/MM/YYYY',
            timeFormat: 'HH:mm',
            defaultSelection: new Date(old_date),
        }); 

        $('#date-time-picker').mobiscroll('setVal', new Date(old_date));

        $("input[name='begin_date']").change(function () {
            check_old++;
            if (check_old >= 2) {
                $('#date-time-picker').mobiscroll().datepicker({
                    controls: ['date', 'time'],
                    touchUi: true,
                    dateFormat: 'DD/MM/YYYY',
                    timeFormat: 'HH:mm',
                    min: until,
                }); 
            }
        });
    } else {
        $('#date-time-picker').mobiscroll().datepicker({
            controls: ['date', 'time'],
            touchUi: true,
            dateFormat: 'DD/MM/YYYY',
            timeFormat: 'HH:mm',
            min: until,
        }); 
    }


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
                    <h2 class="breadcrumb-title">Upload NFT</h2>					
                </div>
            </div>
        </div>
    </div>
    <!-- End  Breadcrumb -->				
</div><!-- End header hero area -->	

<section class="author-details dark-bg-all pt-0 pb-80"><!-- start author details area -->
    <div class="container macaw-tabs-container"><!-- start container -->
        <div class="row"><!-- start row -->
            <div class="col-md-12 col-sm-12 pt-50">	<!-- start col-10 -->
                <div class="upload-area tab-area-bg"> <!-- start tab area -->
                    <form action="{{route('client.upload_item')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p style="padding-left: 42px">* {{ $error }}!</p>
                        @endforeach
                        @endif	
                        <div class="row"> <!-- start row -->
                            <div class="col-md-6"> <!-- start col -->
                                <div class="upload-file-edit">
                                    <div class="upload-file-title">
                                        <h5 class="subtitle">Upload Digital NFT</h5>
                                    </div>
                                    <div class="edit-form"> <!-- start edit form -->			
                                        <div class="form-group edit-form-group">
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control edit-form-control" id="title" placeholder="Title : 3D Art.." required>													
                                        </div>
                                        <div class="form-group edit-form-group" style="height: 50px">
                                            <select name="category" class="form-control edit-form-control wide">
                                                <option disabled selected>Choose Art</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" @php
                                                        echo $category->id == old('category') ? "selected" : "";
                                                    @endphp>{{$category->name}}</option>
                                                @endforeach											  
                                            </select>													
                                        </div>
                                        <div class="relative form-group edit-form-group">   
                                            <label class="datetime-begin">
                                                <input class="form-control edit-form-control" id="date-time-picker" mbsc-input data-input-style="outline" name="begin_date" data-label-style="stacked" placeholder="Please enter start date..." />
                                            </label>   
                                            <input type="hidden" name="old_date" value="{{ old('begin_date') }}">                              
                                        </div>
                                        <div class="form-group edit-form-group" style="height: 50px">
                                            <select name="end_date" class="form-control edit-form-control wide">
                                                <option value="+ 12 hour" @php
                                                    echo "+ 12 hour" == old('end_date') ? "selected" : "";
                                                @endphp>12h</option>										  
                                                <option value="+ 1 day" @php
                                                echo "+ 1 day" == old('end_date') ? "selected" : "";
                                                @endphp>24h</option>
                                                <option value="+ 2 day" @php
                                                echo "+ 2 day" == old('end_date') ? "selected" : "";
                                                @endphp>2 days</option>
                                                <option value="+ 3 day" @php
                                                echo "+ 3 day" == old('end_date') ? "selected" : "";
                                                @endphp>3 days</option>
                                                <option value="+ 4 day" @php
                                                echo "+ 4 day" == old('end_date') ? "selected" : "";
                                                @endphp>4 days</option>
                                                <option value="+ 5 day" @php
                                                echo "+ 5 day" == old('end_date') ? "selected" : "";
                                                @endphp>5 days</option>
                                                <option value="+ 6 day" @php
                                                echo "+ 6 day" == old('end_date') ? "selected" : "";
                                                @endphp>6 days</option>
                                                <option value="+ 1 week" @php
                                                echo "+ 1 week" == old('end_date') ? "selected" : "";
                                                @endphp>1 week</option>
                                            </select>													
                                        </div>
                                        <div class="form-group edit-form-group">
                                            <input type="text" name="price" class="form-control edit-form-control" value="{{ old('price') }}" id="price" placeholder="Price : .... ETH" required>												
                                        </div>
                                        <div class="form-group edit-form-group">
                                            <textarea class="form-control edit-form-control" name="content" id="content" placeholder="Product Description..." required>{{ old('content') }}</textarea>											
                                        </div>											
                                    </div> <!-- end edit form -->			
                                </div> <!-- end account info -->										
                            </div> <!-- end col -->
                            <div class="col-md-6"> <!-- start col -->
                                <div class="left_upload_file text-center pt-70">
                                    <div class="upload_top_area">
                                        <img class="icon" src="{{ asset('client/img/favicon.png') }}" alt="etherino">
                                        <h5>Drag and drop your file</h5>
                                        <p class="upload_color_text">PNG, GIF, JPG, JPEG, PDF, WEBP. <br /> Maximum size : 128 mb.</p>
                                    </div>
                                    <div class="upload_bottom_area">
                                        <p class="color_text"></p>
                                        <a href="#" class="btn-upload-avatar-upload">Browse Files</a>
                                        <input id="imageUpload" class="imageUpload" type="file" name="image">
                                    </div>
                                </div>									
                            </div> <!-- end col -->
                            <div class="col-md-4 text-left"> <!-- start col -->
                                <div class="actions pt-30 ml-10">
                                    <button type="submit" name="submit" id="submit" class="btn-upload-avatar-upload" style="border-radius: 2px">
                                        Upload Item
                                    </button>						
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-4 text-center"> <!-- start col -->
                                <div class="cancel-btn-area pt-30">
                                    <a id="upload_item" href="{{ asset('uploads/item/default.jpg') }}" class="item-popup cancel-btn btn btn-upload">Preview File</a>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-4 text-right"> <!-- start col -->
                                <div class="cancel-btn-area pt-30">
                                    <a href="#." class="cancel-btn btn btn-upload">Cancel Upload</a>
                                </div>
                            </div> <!-- end col -->										
                        </div> <!-- End row -->	
                    </form>						
                </div> <!-- End tab area -->				
            </div> <!-- end col-8 -->		
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end author details area --> 
@endsection