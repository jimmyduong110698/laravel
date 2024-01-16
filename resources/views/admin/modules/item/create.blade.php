@extends('admin.master')

@section('module', 'Category')
@section('action', 'List')
@push('css')
<link rel="stylesheet" href="{{ asset('administrator/css/colors/default.css') }}">
<link rel="stylesheet" href="{{ asset('mylib/css/mobiscroll.jquery.min.css') }}">
<style>
    .form_filter {
        gap: 100px;
    }
    .input_filter select {
        padding: 10px 20px;
        border: none;
        width: 300px;
    }
    .list {
        padding: 0 !important;
    }
    .status_btn {
        height: 70px;
        border-radius: 50%;
        scale: 0.1;
    }
    .status_btn.red {
        background: red;
    }
    @media (max-width: 500px) {
        .form_filter {
            gap: 20px;
            padding: 0 30px;
        }
    }
    .search_field {
        position: relative;
    }
    .search_field input {
        border: none;
        padding: 10px 50px;
    }
    .search_field i {
        position: absolute;
        padding: 8px;
        top: 7px;
        left: 18px;
        border-right: 1px solid #333;
        font-size: 14px;
    }
    .box_detail_content {
        padding: 30px;
        background: #fff;
        border-radius: 15px;
    }
    .upload_image {
        width: 80%;
        margin: 0 auto;
    }
    .box_detail_content  {
        background: #ededed;
    }
    .datetime-begin {
        margin: 0 !important;
        width: 100%;
    }
    #file-upload-image {
        display: none;
    }
    .user_result {
        width: 100%;
        max-height: 100px;
        background: #fff;
        z-index: 200;
        position: absolute;
        top: 45px;
        left: 0;
        display: none;
        overflow: scroll;
    }
    .user_result ul li button {
        width: 100%;
        border: none;
        background: #fff;
    }
    .user_result ul li button:hover {
        background: #c7c7c7;
    }
</style>
@endpush
@push('handlejs')
    <script src="{{ asset('mylib/js/mobiscroll.jquery.min.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $('#sidebar_menu > li:nth-child(2)').addClass('mm-active');
            $('#sidebar_menu > li.mm-active > ul').addClass('mm-show');
            $('ul.mm-show > li:nth-child(2) > a').addClass('active');
        });    
        $(document).ready(function () {
            $('select').niceSelect();
        });
        mobiscroll.setOptions({
            theme: 'ios',
            themeVariant: 'light'
        });

        var now = new Date();
        var until = new Date(now.getFullYear(),now.getMonth(),now.getDate(),now.getHours() + 1);
 
        $('#date-time-picker').mobiscroll().datepicker({
            controls: ['date', 'time'],
            touchUi: true,
            dateFormat: 'DD/MM/YYYY',
            timeFormat: 'HH:mm',
            min: until,
        }); 

        $("#change-image").click(function () {
            $("input[name='image']").trigger('click');
        });
        $("input[name='image']").change(function() {
            var file = this.files[0];
            console.log(file);
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#image").attr("src", e.target.result)
            }

            reader.readAsDataURL(file)
        });
        
        $("input[name='user_name']").change(function (e) {
            e.preventDefault();
            var name = $(this).val();
            var url = $(this).data("url")

            $(".user_result").css("display", "block");
            
            $.ajax({
                type: "POST",
                url: url,
                data: {name: name},
                dataType: "json",
                success: function (response) {
                    $(".user_result ul").html("");
                    response.result.map(value => {
                        $(".user_result ul").append(`
                            <li><button data-name="${value.nick_name}" data-id="${value.id}">${value.nick_name}</button></li>
                        `)
                    });
                }
            });
            $(document).on('click',".user_result ul li button", function (e) {
                e.preventDefault();
               $("input[name='user_name']").val($(this).data("name"));
               $("input[name='user_id']").val($(this).data("id"));
            });
        });
        $(".user_result").mouseout(function () {
            $(".user_result").css("display", "none");
        });
        $(".form_edit_item").click(function () {
            $(".user_result").css("display", "none");
        });
        $(".user_name_input, input[name='user_name']").mouseover(function () {
            if ($("input[name='user_name']").val() != "") {
                $(".user_result").css("display", "block");
            }
        })
    </script>
@endpush
@section('content')
<!-- Default box -->
<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12 white_box_tittle">
                <div class="row box_detail_content align-items-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="upload_image">
                            <img src="{{ asset('uploads/item/default.jpg') }}" width="100%" id="image">
                            <div class="d-grid mt-3">
                                <button id="change-image" type="button" class="btn btn-outline-primary btn-lg mb-3">Change image</button>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12 col-lg-6">
                        <form class="form_edit_item" action="{{route('admin.item.store_item')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" id="file-upload-image">
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Title</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <input class="digits" name="name" type="text" data-language="en">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">User</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker user_name_input" style="position: relative">
                                        <input class="digits" name="user_name" data-url="{{route('admin.user.find_user')}}" type="text" data-language="en">
                                        <input type="hidden" name="user_id">
                                        <div class="user_result">
                                            <ul></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Categories</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <select class="nice-select wide" name="category">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Price</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <input class="digits" name="price" type="number" data-language="en">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Content</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <textarea rows="4" cols="50" name="content" id="descriptionup"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Start date</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group">
                                        <label class="datetime-begin">
                                            <input id="date-time-picker" mbsc-input data-input-style="outline" name="begin_date" data-label-style="stacked" placeholder="Please select..." />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Choose countdown period</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <select class="nice-select wide" name="state" id="maxRows">
                                            <option value="+ 12 hour">12h</option>										  
                                            <option value="+ 1 day">24h</option>
                                            <option value="+ 2 day">2 days</option>
                                            <option value="+ 3 day">3 days</option>
                                            <option value="+ 4 day">4 days</option>
                                            <option value="+ 5 day">5 days</option>
                                            <option value="+ 6 day">6 days</option>
                                            <option value="+ 1 week">1 week</option>
                                        </select>	
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15"></label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <div class="d-grid mt-3">
                                            <button type="submit" class="btn btn-primary btn-lg mb-3">Update item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection