<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin | Etherino</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="themetum Team" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon  -->
<link rel="shortcut icon" href="{{ asset('client/img/favicon.png') }}">

@stack('css')

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('administrator/css/metisMenu.css') }}">

<link rel="stylesheet" href="{{ asset('administrator/css/bootstrap1.min.css') }}" />

<link rel="stylesheet" href="{{ asset('administrator/vendors/themefy_icon/themify-icons.css') }}" />


<link rel="stylesheet" href="{{ asset('administrator/vendors/datatable/css/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('administrator/vendors/datatable/css/responsive.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('administrator/vendors/datatable/css/buttons.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('administrator/vendors/niceselect/css/nice-select.css') }}" />


<link rel="stylesheet" href="{{ asset('administrator/css/style1.css') }}" />
<link rel="icon" href="{{ asset('administratorimg/logo.png" type="image/png') }}">

<style>
    .alert-dismissible {
        margin: 30px 20px;
    }
    .popup {
        width: 100%;
        height: 100%;
        position: fixed;
        background: #3a3a3a7d;
        z-index: 9999;
        visibility: hidden;
        overflow: hidden;
    }
    .box {
        width: 400px;
        border-radius: 5px;
        position: absolute;
        top: 300px;
        left: 39%;
    }
    @media (max-width: 500px) {
        .box {
            width: 100%;
            left: 0;
            top: 300px;
        }
        .box.show {
            transform: translateY(0);
            transition: 1s;
        }
        .box.hidden {
            transform: translateY(300px);
            transition: 1s;
        }
    }
    .active {
        visibility: visible;
    }
    .box.show {
        transform: translateY(0);
        transition: 1s;
    }
    .box.hidden {
        transform: translateY(-600px);
        transition: 1s;
    }
    .modal-content .close {
        border: none;
        width: 30px;
        height: 30px;
        font-size: 19px;
        font-weight: 500;
    }
</style>

