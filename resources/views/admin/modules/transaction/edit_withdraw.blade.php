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
            $('#sidebar_menu > li:nth-child(4)').addClass('mm-active');
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

    </script>
@endpush
@section('content')
<!-- Default box -->
<div class="main_content_iner">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12 white_box_tittle">
                <div class="box_detail_content align-items-center">
                    <form class="form_edit_item row justify-content-center" action="{{route('admin.transaction.update_withdraw',['id' => $item[0]->id])}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">User</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker" style="border: 0.5px solid #333">
                                    <input class="digits" value="{{$item[0]->nick_name}}" name="name" type="text" data-language="en" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Bill code</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker"  style="border: 0.5px solid #333">
                                    <input class="digits" value="{{$item[0]->bill_code}}" name="code" type="text" data-language="en" disabled>
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
                                        echo $item[0]->status == 1 ? "selected" : "";
                                        @endphp>Success</option>
                                        <option value="2" @php
                                        echo $item[0]->status == 2 ? "selected" : "";
                                        @endphp>Proccessing</option>
                                        <option value="3" @php
                                        echo $item[0]->status == 3 ? "selected" : "";
                                        @endphp>Fail</option>
                                    </select>	
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Account number</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <input class="digits" value="{{$item[0]->account_number}}" name="account_number" type="text" data-language="en">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Account name</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <input class="digits" value="{{$item[0]->account_name}}" name="account_name" type="text" data-language="en">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Bank</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <select class="nice-select wide" name="bank">
                                        <option value="NCB" @php
                                        echo $item[0]->bank == "NCB" ? "selected" : "";
                                        @endphp>NCB</option>
                                        <option value="ACB" @php
                                        echo $item[0]->bank == "ACB" ? "selected" : "";
                                        @endphp>ACB</option>
                                        <option value="OCB" @php
                                        echo $item[0]->bank == "OCB" ? "selected" : "";
                                        @endphp>OCB</option>
                                    </select>	
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">ETH</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <input class="digits" value="{{$item[0]->eth}}" name="eth" type="number" data-language="en">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">VND</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <input class="digits" value="{{$item[0]->vnd}}" name="vnd" type="number" data-language="en">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15"></label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <div class="d-grid mt-3">
                                        <button type="submit" class="btn btn-primary btn-lg mb-3 float-right">Update item</button>
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
<!-- /.card -->
@endsection