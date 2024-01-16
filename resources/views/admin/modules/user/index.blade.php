@extends('admin.master')

@section('module', 'Category')
@section('action', 'List')
@push('css')
<link rel="stylesheet" href="{{ asset('administrator/css/colors/default.css') }}">
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
</style>
@endpush
@push('handlejs')
    <script>
        $( document ).ready(function() {
            $('#sidebar_menu > li:nth-child(5)').addClass('mm-active');
            $('#sidebar_menu > li.mm-active > ul').addClass('mm-show');
            $('ul.mm-show > li:nth-child(1) > a').addClass('active');
        });    
        $(document).ready(function () {
            $('select').niceSelect();
        });   
    </script>
@endpush
@section('content')
<!-- Default box -->
<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="search_inner">
                        <form class="row justify-content-between pb-5 form_filter" active="#">
                            <div class="col-md-4 col-sm-12 search_field d-flex input_filter" style="text-align: center">
                                <i class="ti-search"></i>
                                <hr>
                                <input class="wide" type="text" placeholder="Search content here...">
                            </div>
                        </form>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Edit</th> 
                                    <th scope="col">Delete</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @php
                                    $creat_at = DB::table('user_info')->select('user_info.create_date')->find($user->id);
                                @endphp
                                    <tr>
                                        <td scope="row"> <a href="#" class="question_content">{{ $loop->iteration }}</a></td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>
                                            @if ($user->level == 1)
                                            <span class="badge bg-danger">SuperAdmin</span>
                                            @elseif ($user->level == 2) 
                                            <span class="badge bg-primary">Admin</span>
                                            @else
                                            <span class="badge bg-secondary">Menber</span>  
                                            @endif
                                        </td>
                                        <td>{{$user->phone}}</td>
                                        {{-- <td>{{date("d/m/Y H:i:s",strtotime($creat_at->create_date))}}</td> --}}
                                        <td><a href="{{route('admin.user.edit',['id'=>$user->id])}}" class="btn btn-outline-secondary">View more</a></td>
                                        <td><a href="{{route('admin.user.delete',['id'=>$user->id])}}" class="btn btn-outline-danger">Delete</a></td>
                                    </tr>
                                @endforeach       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection