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
                <h3 class="title">{{$user->full_name}} <span>activities</span></h3>
            </div>
            <div class="col-12 default-according mb-5" id="accordionclose">
                <div class="card">
                    <div class="card-header" id="heading1">
                        <h5 class="mb-0">
                            <button class="btn" data-bs-toggle="collapse"
                                data-bs-target="#collapse1" aria-expanded="true"
                                aria-controls="heading1">List of items<span
                                    class="digits"></span></button>
                        </h5>
                    </div>
                    <div class="collapse show" id="collapse1" aria-labelledby="heading1"
                    data-parent="#accordionclose">
                        <div class="col-12 container mt-3">
                            <div class="QA_section">
                                {{-- <div class="search_inner">
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
                                </div> --}}
                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Owner</th>
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
                <div class="card">
                    <div class="card-header" id="heading2">
                        <h5 class="mb-0">
                            <button class="btn" data-bs-toggle="collapse"
                                data-bs-target="#collapse2" aria-expanded="true"
                                aria-controls="heading2">List of bids<span
                                    class="digits"></span></button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapse2" aria-labelledby="heading2"
                    data-parent="#accordionclose">
                        <div class="col-12 container mt-3">
                            <div class="QA_section">
                                {{-- <div class="search_inner">
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
                                </div> --}}
                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Auctioneer</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Bidding time</th>
                                                <th scope="col">View more</th>
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
                                                    <td><button data-price="{{$bid->price}}" data-status="{{$bid->status}}" data-bid-id="{{$bid->id}}"
                                                        class="btn btn-outline-secondary bid_view_more">Edit</button>
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
                <div class="card">
                    <div class="card-header" id="heading3">
                        <h5 class="mb-0">
                            <button class="btn" data-bs-toggle="collapse"
                                data-bs-target="#collapse3" aria-expanded="true"
                                aria-controls="heading3">List of recharge<span
                                    class="digits"></span></button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapse3" aria-labelledby="heading3"
                    data-parent="#accordionclose">
                        <div class="col-12 container mt-3">
                            <div class="QA_section">
                                {{-- <div class="search_inner">
                                    <div class="row justify-content-between pb-5 form_filter">
                                        <div class="col-md-3 col-sm-12 search_field d-flex input_filter" style="text-align: center">
                                            <button class="add_transaction"><a href="{{route('admin.transaction.create_recharge')}}">Add New</a></button>
                                        </div>
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
                                </div> --}}
                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Bill code</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">ETH</th>
                                                <th scope="col">VND</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Created at</th>
                                                <th scope="col">View more</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bills as $bill)
                                                <tr>
                                                    <td scope="row"> <a href="#" class="question_content">{{$bill->id}}</a></td>
                                                    <td>{{$bill->bill_code}}</td>
                                                    <td>
                                                        @if ($bill->status == 1)
                                                        <span class="badge bg-success">Success</span>
                                                        @elseif ($bill->status == 2) 
                                                        <span class="badge bg-warning">Proccessing</span>
                                                        @else
                                                        <span class="badge bg-danger">Fail</span>  
                                                        @endif
                                                    </td>
                                                    <td>{{$bill->eth}} ETH</td>
                                                    <td>{{$bill->vnd}} VND</td>
                                                    <td>{{$bill->nick_name}}</td>
                                                    <td>{{$bill->create_date}}</td>
                                                    <td>
                                                        <a href="{{route('admin.transaction.recharge_edit',['id'=>$bill->id])}}" class="btn btn-outline-secondary">View more</a>
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
                <div class="card">
                    <div class="card-header" id="heading4">
                        <h5 class="mb-0">
                            <button class="btn" data-bs-toggle="collapse"
                                data-bs-target="#collapse4" aria-expanded="true"
                                aria-controls="heading4">List of withdraw<span
                                    class="digits"></span></button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapse4" aria-labelledby="heading4"
                    data-parent="#accordionclose">
                        <div class="col-12 container mt-3">
                            <div class="QA_section">
                                {{-- <div class="search_inner">
                                    <div class="row justify-content-between pb-5 form_filter">
                                        <div class="col-md-3 col-sm-12 search_field d-flex input_filter" style="text-align: center">
                                            <button class="add_transaction"><a href="{{route('admin.transaction.create_withdraw')}}">Add New</a></button>
                                        </div>
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
                                </div> --}}
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
                                            @foreach ($withdraws as $withdraw)
                                                <tr>
                                                    <td scope="row"> <a href="#" class="question_content">{{$withdraw->id}}</a></td>
                                                    <td>{{$withdraw->bill_code}}</td>
                                                    <td>
                                                        @if ($withdraw->status == 1)
                                                        <span class="badge bg-success">Success</span>
                                                        @elseif ($withdraw->status == 2) 
                                                        <span class="badge bg-warning">Proccessing</span>
                                                        @else
                                                        <span class="badge bg-danger">Fail</span>  
                                                        @endif
                                                    </td>
                                                    <td>{{$withdraw->eth}}</td>
                                                    <td>{{$withdraw->account_number}}</td>
                                                    <td>
                                                        <a href="{{route('admin.transaction.edit_withdraw',['id'=>$withdraw->id])}}" class="btn btn-outline-secondary">View more</a>
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
        </div>
    </div>
</div>
<!-- /.card -->
@endsection