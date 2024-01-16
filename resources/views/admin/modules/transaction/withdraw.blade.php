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
    .add_transaction {
        border: none;
        background: #fff;
        padding: 5px 30px;
        border: 1px solid #c5c5c5;
    }
    .add_transaction a {
        color: #333;
    }
</style>
@endpush
@push('handlejs')
    <script>
        $( document ).ready(function() {
            $('#sidebar_menu > li:nth-child(4)').addClass('mm-active');
            $('#sidebar_menu > li.mm-active > ul').addClass('mm-show');
            $('ul.mm-show > li:nth-child(2) > a').addClass('active');
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
                        <div class="row justify-content-between pb-5 form_filter">
                            <div class="col-md-3 col-sm-12 search_field d-flex input_filter" style="text-align: center">
                                <i class="ti-search"></i>
                                <hr>
                                <input class="wide" name="search" type="text" placeholder="Search content here...">
                            </div>
                            <div class="col-md-3 col-sm-12 category_input input_filter">
                                <select class="nice-select wide" name="filter_date" id="maxRows">
                                    <option value="1">Today</option>
                                    <option value="2">Last day</option>
                                    <option value="3">Last week</option>
                                    <option value="4">Last month</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Bill code</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">ETH</th>
                                    <th scope="col">Account number</th>
                                    <th scope="col">View more</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td scope="row"> <a href="#" class="question_content">{{$item->id}}</a></td>
                                        <td>{{$item->bill_code}}</td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge bg-success">Success</span>
                                            @elseif ($item->status == 2) 
                                            <span class="badge bg-warning">Proccessing</span>
                                            @else
                                            <span class="badge bg-danger">Fail</span>  
                                            @endif
                                        </td>
                                        <td>{{$item->eth}}</td>
                                        <td>{{$item->account_number}}</td>
                                        <td>
                                            <a href="{{route('admin.transaction.edit_withdraw',['id'=>$item->id])}}" class="btn btn-outline-secondary">View more</a>
                                        </td>
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