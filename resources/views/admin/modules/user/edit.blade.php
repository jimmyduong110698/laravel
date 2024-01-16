@extends('admin.master')

@section('module', 'Category')
@section('action', 'Create')

@push('css')
<link rel="stylesheet" href="{{ asset('administrator/vendors/datepicker/date-picker.css') }}">
<style>
    .nice-select ul {
        padding: 0 !important;
    }
    .custom-file-input {
        display: none;
    }
    .btn-upload {
        position: absolute;
        top: 70px;
        left: 100px;
        padding: 10px;
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
    $(".btn-upload").click(function () {
       $(".custom-file-input").trigger('click');
    });
    $("input[name='avatar']").change(function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#avatar").attr("src", e.target.result)
        }

        reader.readAsDataURL(file)
    });
</script>
@endpush

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="profile_box_1">
                    <div class="profile-cover-image">
                        <img src="{{ asset('uploads/avatar/background.jpg') }}">
                    </div>
                    <div class="profile-picture">
                        <img src="{{ asset('uploads/avatar/avatar.png') }}" id="avatar" alt="Avatar">
                        <div class="upload-avatar">
                            <h3 class="btn-upload">Upload</h3>
                            <input type="file"  class="custom-file-input" name="avatar">
                        </div>
                        
                    </div>
                    <div class="profile-content">
                        <h1>
                            {{$user[0]->full_name}}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card_box box_shadow position-relative mb_30">
                    <div class="box_body">
                        <div class="date-picker">
                            <form class="theme-form" action="{{route('admin.user.update',['id'=>$id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Email</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="email" type="text" data-language="en" value="{{$user[0]->email}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Level</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group">
                                                    <select class="nice-select wide" name="level" @php
                                                        echo Auth::user()->id == $user[0]->id || Auth::user()->level >= $user[0]->level  ? "disabled" : "";
                                                    @endphp>
                                                        <option value="1" @php echo $user[0]->level == 1 ? "selected" : ""  @endphp>SuperAdmin</option>
                                                        <option value="2" @php echo $user[0]->level == 2 ? "selected" : ""  @endphp>Admin</option>
                                                        <option value="3" @php echo $user[0]->level == 3 ? "selected" : ""  @endphp>Menber</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Full name</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" value="{{$user[0]->full_name}}" name="full_name" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Nick name</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" value="{{ $user[0]->nick_name}}" name="nick_name" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Gender</label>
                                            <div class="col-xl-5 col-sm-9 d-flex align-items-center">
                                                <label style="margin: 0 20px 0 0" for="male">Male</label>
                                                <input type="radio" name="gender" id="male" value="1" @php echo $user[0]->gender == 1 ? "checked" : ""  @endphp>
                                                <label style="margin: 0 20px" for="female">Female</label>
                                                <input type="radio" name="gender" id="female" value="2" @php echo $user[0]->gender == 2 ? "checked" : ""  @endphp>
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
                                                    <input class="digits" name="citizen_id" value="{{$user[0]->citizen_id}}" type="text" data-language="en" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Phone</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" value="{{$user[0]->phone}}" name="phone" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Address</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <input class="digits" name="address" value="{{$user[0]->addresss}}" type="text" data-language="en">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Day of birth</label>
                                            <div class="col-xl-5 col-sm-9 common_date_picker">
                                                <input class="digits" name="birthday" value="{{$user[0]->date_of_birth}}" type="date" id="dt">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Content</label>
                                            <div class="col-xl-5 col-sm-9">
                                                <div class="input-group common_date_picker">
                                                    <textarea rows="4" cols="50" name="content" id="descriptionup">{{$user[0]->content}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3 "></div>
                                    <div class="col-6 mt-3 d-flex flex-row-reverse gap-3">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                        <a href="{{route('admin.user.activities',['id'=>$user[0]->id])}}" class="btn btn-secondary">View activities</a>
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