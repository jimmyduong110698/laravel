@extends('admin.master')

@section('module', 'Category')
@section('action', 'Create')

@push('css')
<link rel="stylesheet" href="{{ asset('administrator/vendors/datepicker/date-picker.css') }}">
<style>
    .nice-select ul {
        padding: 0 !important;
    }
    input[type="file"]::file-selector-button {
        visibility: hidden;
    }
</style>
@endpush
@push('handlejs')
<script src="{{ asset('administrator/vendors/datepicker/datepicker.js') }}"></script>
<script src="{{ asset('administrator/vendors/datepicker/datepicker.en.js') }}"></script>
<script src="{{ asset('administrator/vendors/datepicker/datepicker.custom.js') }}"></script>
<script>  
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
            @php
                $user_info = DB::table('user_info')->find($user->id);
            @endphp
            <div class="col-12">
                <div class="profile_box_1">
                    <div class="profile-cover-image">
                        <img src="{{ asset('uploads/avatar/background.jpg') }}">
                    </div>
                    <div class="profile-picture">
                        <img src="{{ asset('uploads/avatar/'.$user_info->avatar) }}" alt="Avatar">
                        <input type="file"  class="custom-file-input" name="avatar" id="avatar">
                    </div>
                    <div class="profile-content">
                        <h1>
                            {{$user->full_name}}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card_box box_shadow position-relative mb_30">
                    <div class="box_body">
                        <div class="date-picker">
                            <form class="theme-form" action="{{route('admin.user.update',['id'=>$user->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Email</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="email" type="text" data-language="en" value="{{$user->email}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Full name</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" value="{{$user->full_name}}" name="full_name" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Nick name</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" value="{{ $user_info->nick_name}}" name="nick_name" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Gender</label>
                                            <div class="col-xl-5 col-sm-9 d-flex align-items-center">
                                                <label style="margin: 0 20px 0 0" for="male">Male</label>
                                                <input type="radio" name="gender" id="male" value="1" @php echo $user_info->gender == 1 ? "checked" : ""  @endphp>
                                                <label style="margin: 0 20px" for="female">Female</label>
                                                <input type="radio" name="gender" id="female" value="2" @php echo $user_info->gender == 2 ? "checked" : ""  @endphp>
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
                                                    <input class="digits" name="citizen_id" value="{{$user->citizen_id}}" type="text" data-language="en" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Phone</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" value="{{$user->phone}}" name="phone" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Address</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="address" value="{{$user->addresss}}" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Day of birth</label>
                                            <div class="col-xl-5 col-sm-9 common_date_picker">
                                                <input class="digits" name="birthday" value="{{$user->date_of_birth}}" type="date" id="dt">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Content</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <textarea rows="4" cols="50" name="content" id="descriptionup">{{$user_info->content}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3 ">
                                        <button class="btn btn-primary" type="submit">Edit</button>
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