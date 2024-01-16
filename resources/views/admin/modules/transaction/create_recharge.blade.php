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
            $('#sidebar_menu > li:nth-child(4)').addClass('mm-active');
            $('#sidebar_menu > li.mm-active > ul').addClass('mm-show');
            $('ul.mm-show > li:nth-child(1) > a').addClass('active');
        });    
        $(document).ready(function () {
            $('select').niceSelect();
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

        $("input[name='eth']").change(function () {
            $("input[name='vnd']").val($(this).val()*10000);
        })

    </script>
@endpush
@section('content')
<!-- Default box -->
<div class="main_content_iner">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12 white_box_tittle">
                <div class="box_detail_content align-items-center">
                    <form class="form_edit_item row justify-content-center" action="{{route('admin.transaction.store_recharge')}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">User</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <input class="digits" name="user_name"  type="text" data-url="{{route('admin.user.find_user')}}" data-language="en">
                                    <input type="hidden" name="user_id">
                                    <div class="user_result">
                                        <ul></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Status</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <select class="nice-select wide" name="status" id="maxRows">
                                        <option value="1">Success</option>
                                        <option value="2">Proccessing</option>
                                        <option value="3">Fail</option>
                                    </select>	
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">ETH</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <input class="digits" name="eth" type="number" data-language="en">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">VND</label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <input class="digits" name="vnd" type="number" data-language="en">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label
                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15"></label>
                            <div class="col-xl-5 col-sm-9">
                                <div class="input-group common_date_picker">
                                    <div class="d-grid mt-3">
                                        <button type="submit" class="btn btn-primary btn-lg mb-3 float-right">Create item</button>
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