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
    body {
        position: relative;
    }
</style>
@endpush
@push('handlejs')
    <script>
        $( document ).ready(function() {
            $('#sidebar_menu > li:nth-child(3)').addClass('mm-active');
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
                        <form class="row justify-content-between pb-5" data-url="{{route('admin.bid.filter_bid')}}" id="form_filter">
                            @csrf
                            <div class="col-md-4 col-sm-12"></div>
                            <div class="col-md-4 col-sm-12"></div>
                            <div class="col-md-4 col-sm-12 category_input input_filter">
                                <select class="nice-select wide" name="filter_date" id="maxRows">
                                    <option value="1">Today</option>
                                    <option value="2">Last day</option>
                                    <option value="3">Last week</option>
                                    <option value="4">Last month</option>
                                </select>	
                            </div>
                        </form>
                    </div>
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
</div>
<!-- /.card -->
@endsection