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
    .box_detail_content {
        padding: 30px;
        background: #fff;
        border-radius: 15px;
    }
    body {
        position: relative;
    }
</style>
@endpush
@push('handlejs')
    <script>
        $( document ).ready(function() {
            $('#sidebar_menu > li:nth-child(2)').addClass('mm-active');
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
            <div class="col-12 white_box_tittle">
                <div class="row box_detail_content align-items-center">
                    <div class="col-md-12 col-lg-6 text-center">
                        <img src="{{ asset('uploads/item/'.$item->image) }}"  height="300px">
                    </div> 
                    <div class="col-md-12 col-lg-6">
                        <div class="box_body">
                            <h3>{{$item->name}}</h3>
                            <p class="f-w-400 ">{{$item->content}}</p>
                            <p><strong>Create at: </strong>{{date("d/m/Y H:i:s",strtotime($item->create_date))}}</p>
                            <p><strong>Begin at: </strong>{{date("d/m/Y H:i:s",strtotime($item->begin_date))}}</p>
                            <p><strong>End at: </strong>{{date("d/m/Y H:i:s",strtotime($item->end_date))}}</p>
                            <p><strong>Status: </strong>
                                @if ($item->status == 1)
                                <span class="badge bg-success">Active</span>
                                @elseif ($item->status == 2)
                                <span class="badge bg-dark">Ended</span>
                                @elseif ($item->status == 3)
                                <span class="badge bg-warning">Await</span>
                                @else
                                <span class="badge bg-danger">Bannded</span>
                                @endif
                            </p>
                            <p><strong>Owner: </strong>{{$item->nick_name}}</p>
                        </div>
                        <hr>
                        <div class="d-grid">
                            <a href="{{route('admin.item.edit_item',['id'=>$item->id])}}" class="btn btn-outline-primary btn-lg mb-3">Edit item</a>
                        </div>
                        @if ($item->status == 3)
                        <div class="d-grid">
                            <a href="{{route('admin.item.approve_item',['id' => $item->id])}}" class="btn btn-outline-success btn-lg mb-3">Approve</a>
                        </div>
                        @endif
                        <div class="d-grid">
                            <a href="{{route('admin.item.ban_item',['id'=>$item->id])}}" class="btn btn-outline-danger btn-lg">Ban item</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 QA_section mt-3">
                <div class="QA_table mb_30">
                    <table class="table lms_table_active">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Price</th>
                                <th scope="col">Auctioneer</th>
                                <th scope="col">Status</th>
                                <th scope="col">Bidding time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bids as $bid)
                                <tr>
                                    <td scope="row"> <a href="#" class="question_content">{{$bid->id}}</a></td>
                                    <td>{{$bid->price}} ETH</td>
                                    <td>{{$bid->nick_name}}</td>
                                    <td>
                                        @if ($bid->status == 1)
                                        <span class="badge bg-primary">Active</span>
                                        @elseif ($bid->status == 3)
                                        <span class="badge bg-success">Success</span>  
                                        @else
                                        <span class="badge bg-danger">Fail</span>  
                                        @endif
                                    </td>
                                    <td>{{$bid->create_date}}</td>
                                </tr>
                            @endforeach       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection