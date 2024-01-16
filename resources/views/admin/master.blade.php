<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.dashboardpack.com/directory-html/index_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 Nov 2023 12:56:26 GMT -->
<head>
 @include('admin.partials.head')
</head>
<body class="crm_body_bg">
    {{-- popup bid view more --}}
    <div class="popup" id="bid_popup"><!-- start bid successful -->
        <div class="box hidden">
            <div class="modal-content col-12">
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body space-y-20 p-40">
                    <div class="content-bid">
                        <form class="form_edit_item" action="{{route('admin.bid.edit_bid')}}" method="POST">
                            @csrf
                            <input type="hidden" name="bid_id">
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Price</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group common_date_picker">
                                        <input class="digits" name="price" type="number" data-language="en">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Status</label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="input-group" id="select_id">
                                        <select class="nice-select wide" name="status" >
                                            <option value="1">Active</option>										  
                                            <option value="2">Fail</option>
                                            <option value="3">Success</option>
                                        </select>	
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15"></label>
                                <div class="col-xl-5 col-sm-9">
                                    <div class="d-grid mt-3">
                                        <button type="submit" class="btn btn-primary">Update bid</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.partials.sidebar')


<section class="main_content dashboard_part">
    {{-- container-fluid --}}
    @include('admin.partials.content-header')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">{{$error}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    @yield('content')

    
    @include('admin.partials.footer')
</section>
    



@include('admin.partials.foot')
<script type="text/javascript">
    $(document).ready(function(){
        $('.sidebar-menu li').click(function(e) {
            e.stopPropagation();
        $(this).children('ul').slideToggle();
        });
    });
</script>
</body>

<!-- Mirrored from demo.dashboardpack.com/directory-html/index_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 Nov 2023 12:56:26 GMT -->
</html>