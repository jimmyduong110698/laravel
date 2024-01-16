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
            <div class="col-12">
                <div class="QA_section">
                    <div class="search_inner">
                        <form class="row justify-content-between pb-5 form_filter" id="form_filter" data-url="{{route('admin.item.item_filter')}}">
                            @csrf
                            <div class="col-md-3 col-sm-12 category_input input_filter">
                                <select class="nice-select wide" name="category">
                                    <option value="0">Show All</option>
                                    @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>	
                            </div>
                            <div class="col-md-3 col-sm-12 search_field d-flex input_filter" style="text-align: center">
                                <i class="ti-search"></i>
                                <hr>
                                <input class="wide" name="search" type="text" placeholder="Search content here...">
                            </div>
                            <div class="col-md-3 col-sm-12 category_input input_filter">
                                <select class="nice-select wide" name="state">
                                    <option value="1">Being Auctioned</option>
                                    <option value="2">Auction Ended</option>
                                    <option value="3">Awaiting approval</option>
                                    <option value="4">Banned</option>
                                </select>	
                            </div>
                        </form>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Owner (nick name)</th>
                                    <th scope="col">Auctions</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View more</th>
                                    <th scope="col">Ban</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                @php
                                    $count = DB::table('bids')->select(DB::raw('COUNT(bids.item_id) as count'))->where('item_id',$item->id)->get();
                                @endphp
                                    <tr>
                                        <td scope="row"> <a href="#" class="question_content">{{$item->id}}</a></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->price}} ETH</td>
                                        <td>{{$item->nick_name}}</td>
                                        <td>{{$count[0]->count}}</td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge bg-success">Active</span>
                                            @elseif ($item->status == 2)
                                            <span class="badge bg-dark">Ended</span>
                                            @elseif ($item->status == 3)
                                            <span class="badge bg-warning">Await</span>
                                            @else
                                            <span class="badge bg-danger">Bannded</span>
                                            @endif
                                        </td>
                                        <td><a href="{{route('admin.item.item_detail',['id'=>$item->id])}}" type="button" class="btn btn-outline-secondary">View more</a></td>
                                        <td><a href="{{route('admin.item.ban_item',['id'=>$item->id])}}" class="btn btn-outline-danger">Ban</a></td>
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