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
</style>
@endpush
@push('handlejs')
    <script src="{{ asset('mylib/js/mobiscroll.jquery.min.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $('#sidebar_menu > li:nth-child(2)').addClass('mm-active');
            $('#sidebar_menu > li.mm-active > ul').addClass('mm-show');
            $('ul.mm-show > li:nth-child(1) > a').addClass('active');
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
        var old_date = $("input[name='old_date']").val();

        old_date = old_date.split("-");
        const year = old_date[0];
        const month = old_date[1];
        old_date = old_date[2].split(" ");
        const day = old_date[0];
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
                            <img src="{{ asset('uploads/item/'.$item->image) }}" width="100%" id="image">
                        </div>
                    </div> 
                    <div class="col-md-12 col-lg-6">
                        <form class="form_edit_item" action="{{route('admin.item.update_item',['id'=>$item->id])}}" method="POST">
                            @csrf
                            <input type="file" name="image" id="file-upload-image">
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Title</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <input class="digits" value="{{$item->name}}" name="name" type="text" data-language="en">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Status</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <select class="nice-select wide" name="status" id="maxRows">
                                            <option value="1" @php
                                            echo $item->status == 1 ? "selected" : "";
                                            @endphp>Active</option>										  
                                            <option value="2" @php
                                            echo $item->status == 2 ? "selected" : "";
                                            @endphp>Ended</option>
                                            <option value="3" @php
                                            echo $item->status == 3 ? "selected" : "";
                                            @endphp>Waiting</option>
                                            <option value="4" @php
                                            echo $item->status == 4 ? "selected" : "";
                                            @endphp>Bannded</option>
                                        </select>	
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
                                            <option value="{{$category->id}}" @php
                                                echo $item->category_id == $category->id ? "selected" : "";
                                            @endphp>{{$category->name}}</option>
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
                                        <input class="digits" value="{{$item->price}}" name="price" type="number" data-language="en">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Content</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <textarea rows="4" cols="50" name="content" id="descriptionup">{{$item->content}}</textarea>
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
                                <input type="hidden" name="old_date" value="{{$item->begin_date}}">
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
                                            <button href="{{route('admin.item.edit_item',['id'=>$item->id])}}" type="submit" class="btn btn-primary btn-lg mb-3">Update item</button>
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