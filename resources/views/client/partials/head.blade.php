<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Etherino | NFT HTML Marketplace</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="themetum Team" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon  -->
<link rel="shortcut icon" href="{{ asset('client/img/favicon.png') }}">
<!-- CSS File  -->
<link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/boxicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/macaw-elegant-tabs.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/meanmenu.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">

<style>
    .btn-login a{
    cursor: pointer;
    border: 0;
    border-radius: 4px;
    font-weight: 600;
    margin: 0 10px;
    padding: 10px 20px;
    box-shadow: 0 0 20px rgba(104, 85, 224, 0.2);
    transition: 0.4s;
    }

    .btn-login .log {
    width: 100%;
    color: rgb(104, 85, 224);
    background-color: rgba(255, 255, 255, 1);
    border: 1px solid rgba(104, 85, 224, 1);
    }
    
    .btn-login a:hover {
    color: white;
    width:;
    box-shadow: 0 0 20px rgba(104, 85, 224, 0.6);
    background-color: rgba(104, 85, 224, 1);
    }
    .btn_placebid {
        background: var(--btnbg-color) !important;
        border-radius: 0.5rem;
        position: relative;
        color: var(--light-color) !important;
        font-weight: 500;
        padding: 12px 90px;
    }
    @media (min-width: 768px) and (max-width: 1090px) {
        a.placebid.price {
            padding: 12px 35px;
        }
    }
    .bell-notify {
        font-size: 28px; 
        color: var(--nav-color);
        padding: 5px; 
        margin-top: 3px; 
        border: 2px solid var(--nav-color); 
        border-radius: 50%;
    }
    .notify {
        position: relative;
        margin-left: 10px; 
        height: 40px;
    }
    .dot-notify {
        position: absolute;
        text-align: center;
        top:-3px;
        left: 27px;
        color: #fff;
        line-height: 25px;
        font-size: 12px;
        background: #ff4927;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: none;
    }
    .dot-notify.show {
        display: block;
    }
    .notify-menu {
        position: absolute;
        top: 61px;
        right: 0;
        background: #fff;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        width: 360px;
        border-radius: 15px;
        max-height: 300px;
        overflow: scroll;
        display: none;
    }
    .notify-menu h5 {
        width: 300px;
    }
    @media (max-width: 500px) {
        .notify-menu {
           width: 280px;
           right: -50px;
        }
        .notify-menu h5 {
            width: 200px;
        }
    }
    .notify-title {
        padding: 20px 0 10px 20px;
        color: #333;
    }
    .notify-title h5 {
        font-weight: 700;
    }
    .btn-notify {
        border: none;
        margin-left: 20px;
        padding: 7px 14px;
        border-radius: 15px;
        background: #fff;
        color: #050505;
    } 
    .btn-notify.selected {
        color: #3578E5;
        background: #ECF3FF;
    }
    .btn-notify.selected:hover {
        background: #E4E6EB;
    }
    .btn-notify:hover {
        background: #e9e9ec;
    }
    .notify-menu-ul {
        padding: 10px 10px 10px 20px;
    }
    .notify-menu-li {
        padding: 10px 0;
        border-radius: 15px;
    }
    .text-notify p {
        padding-left: 10px; 
        margin-bottom: 0;
    }
    .text-notify h6 {
        padding-left: 10px; 
    }
    .text-notify span {
        padding-left: 10px;
        font-weight: 500;
        color: #0866FF; 
    }
    .action-nav {
        position: relative;
    }
    .action-nav .profile-nav-main .profile-pop-otr {
        top: 61px;
    }
    @media (max-width: 800px) {
        .action-nav .profile-nav-main .profile-pop-otr {
            right: -60px !important;
            max-width: 300px;
        }
    }
    .single_product_img {
        display: flex;
        justify-content: center;
    }
    .theme_preview_link img {
        height: 200px;
    }

</style>
<audio id="myAudio">
    <source src="../uploads/sound/facebook_messenger.mp3" type="audio/mpe" type="audio/mpeg">
</audio>

@stack('css')


