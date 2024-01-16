@extends('admin.master')

@section('module', 'Category')
@section('action', 'Create')

@push('css')
<link rel="stylesheet" href="{{ asset('administrator/vendors/datepicker/date-picker.css') }}">
<style>
    .nice-select ul {
        padding: 0 !important;
    }
</style>
@endpush
@push('handlejs')
<script src="{{ asset('administrator/vendors/datepicker/datepicker.js') }}"></script>
<script src="{{ asset('administrator/vendors/datepicker/datepicker.en.js') }}"></script>
<script src="{{ asset('administrator/vendors/datepicker/datepicker.custom.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('#sidebar_menu > li:nth-child(5)').addClass('mm-active');
        $('#sidebar_menu > li.mm-active > ul').addClass('mm-show');
        $('ul.mm-show > li:nth-child(2) > a').addClass('active');
    });    
    $(document).ready(function () {
        $('select').niceSelect();
        $('.nice-select-search-box').hidden();
    });   
    document.getElementById('dt').max = new Date('01/01/2006').toISOString().split("T")[0];
</script>
@endpush

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="dashboard_header mb_50">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                   {{$error}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                            @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Create success !!!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ Session::get('success') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card_box box_shadow position-relative mb_30">
                    <div class="box_body">
                        <div class="date-picker">
                            <form class="theme-form" action="{{route('admin.user.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Email</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="email" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Level</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group">
                                                    <select class="nice-select wide" name="level">
                                                        <option value="1">SuperAdmin</option>
                                                        <option value="2">Admin</option>
                                                        <option value="3">Menber</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Full name</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="full_name" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Nick name</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="nick_name" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Gender</label>
                                            <div class="col-xl-5 col-sm-9 d-flex align-items-center">
                                                <label style="margin: 0 20px 0 0" for="male">Male</label>
                                                <input type="radio" name="gender" id="male" value="1" checked>
                                                <label style="margin: 0 20px" for="female">Female</label>
                                                <input type="radio" name="gender" id="female" value="2">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Password</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <input type="password" style="border: none;" name="password" class="form-control account_style" id="password">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Confirm password</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <input type="password" style="border: none;" name="password_confirmation" class="form-control account_style" id="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Citizen ID</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="citizen_id" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Phone</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="phone" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Address</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="address" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Day of birth</label>
                                            <div class="col-xl-5 col-sm-9 common_date_picker">
                                                <input class="digits" name="birthday" type="date" id="dt">
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
                                    </div>
                                    <div class="col-12 text-center mt-3 ">
                                        <button class="btn btn-primary" type="submit">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection