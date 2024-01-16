import { getPagination } from "./pagination.js";
import { setCountdown } from "./multi-countdown.js";

var debounce = (func, delay) => {
    let debounceTimer
    return function () {
        const context = this
        const args = arguments
        clearTimeout(debounceTimer)
        debounceTimer
            = setTimeout(() => func.apply(context, args), delay)
    }
}

//-------Ajax filter------//
$(document).on('change', "select[name='category'],input[name='filter_date'],input[name='end_soon'],select[name='sort_item'],input[name='search']", debounce(function (e) {
    e.preventDefault();
    var category = $("select[name='category']").val();
    var sort_by = $("select[name='sort_item']").val();
    var search = $("input[name='search']").val();
    var check_auth = $("#check_auth").val();
    var url = $("input[name='url']").data("url");
    var end_soon = document.getElementById("end_soon").checked;
    var end_auction = document.getElementById("filter_date").checked;

    console.log(end_auction);


    $.ajax({
        type: "POST",
        url: url,
        data: { category: category, sort_by: sort_by, end_soon: end_soon, search: search, end_auction: end_auction },
        dataType: "json",
        success: function (response) {
            console.log(response.result)
            $("#table-id").html("");
            response.result.map(value => {
                $("#table-id").append(`
                <div class="col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s"><!-- start col-4 -->
                    <div class="single_product mt-50 pb-30"> <!-- Single Product -->
                        <div class="jumbotron countdown show" data-Date='${value.end_date}' data-endText="Auction ended">					
                            <div class="running">
                                <span class="timer">
                                <span class="days"></span>d
                                <span class="hours"></span>h
                                <span class="minutes"></span>m
                                <span class="seconds"></span>s
                                </span>							  
                            </div>
                        </div> <!-- end count down -->					
                        <div class="single_product_img"><!-- start single product img -->						
                            <a href="{{route('client.detail',['id'=>$item->id])}}" class="theme_preview_link">
                                <img src="../uploads/item/${value.image}" alt="" class="responsive-fluid" />						
                            </a>
                        </div> <!-- End single product img -->
                        <div class="nft_product_description"><!-- start product description -->
                            <div class="nft_product_text">				
                                <ul class="author-profile-link"><!-- start author-->													
                                    <li class="nav-item">									
                                        <a href="author-details.html" class="author_link">
                                            <img src="../uploads/avatar/${value.avatar}" alt="author" class="responsive-fluid img-2" />
                                            <i class='bx bxs-check-circle'></i>
                                        </a>								
                                    </li>
                                    <li class="nav-item">
                                        <span class="hover_author_link">
                                            <a href="author-details.html" class="author_link_text">@galaxy01</a>
                                        </span>										
                                    </li>	
                                </ul>	
                            </div><!-- end author-->																		
                            <div class="product_title_link"><!-- start product title-->			
                                <a class="product-title" href="#">
                                    <h6 class="product_title_intro">${value.name}</h6>	
                                </a>								
                            </div><!-- end product title-->		
                        </div><!-- end product text -->
                        <div class="nft_product_link"><!-- start product link -->					
                            <ul>
                                <li class="product-all-icon">
                                    <span class="item-history product-icon">											
                                        <a href="#" class="item-history-btn" data-toggle="modal" data-target="#popup_history" data-url="http://127.0.0.1:8000/bid_history" data-id="${value.id}">
                                            <i class='bx bx-comment-detail'></i>
                                        </a>											
                                    </span>									
                                </li>
                                    <li class="product-all-icon">										
                                        <span class="report-icon product-icon">
                                                <a href="#" class="report-link" data-toggle="modal" data-target="#popup_share">
                                                    <i class='bx bxs-share-alt'></i>
                                                </a>
                                        </span>	
                                    </li>
                                    <li class="product-all-icon">										
                                        <span class="report-icon product-icon">
                                                <a href="#" class="report-link" data-toggle="modal" data-target="#popup_report">
                                                    <i class='bx bxs-flag-alt'></i>
                                                </a>
                                        </span>	
                                    </li>
                                    <li class="product-all-icon">										
                                        <span class="sale-count product-icon">
                                                <span class="sale-counter">Unit : ${value.price} ETH</span>	
                                        </span>	
                                    </li>										
                            </ul>
                        </div><!-- end product link -->		
                        <div class="place-bid"><!-- start place bid -->
                            ${value.status == 2 ? `<a data-toggle="modal" data-target="popup_bid_cancel" href="#">Cancel</a>` : `
                            <a href="#" class="placebid price" data-toggle="modal" data-target=${check_auth === "true" ? "#popup_bid" : "#popup_bid_alert"}
                            data-bid-url="http://127.0.0.1:8000/bid_success" data-url="http://127.0.0.1:8000/bid_now" data-id="${value.id}">Bid Now</a>
                            `}
                        </div><!-- end place bid -->					
                    </div><!-- end Single Product -->
                </div> <!-- End col-4 -->  
                `);
            });
            getPagination('#table-id');
            setCountdown();
        }
    });
}));
$(document).ready(function () {

    //-------CSRF-Jquery------//
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //-------Ajax bid history------//
    $(document).on('click', ".item-history-btn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        var url = $(this).data("url");


        $.ajax({
            type: "GET",
            url: url,
            data: { dataSearch: id },
            dataType: "json",
            success: function (response) {
                $("#popup_history .modal-dialog .modal-content .modal-body").html("<h4> Bidding Activity </h4>");
                if (response.result == 0) {
                    $("#popup_history .modal-dialog .modal-content .modal-body").append("<h6> No bids activities </h6>");
                    $("#popup_history .modal-dialog .modal-content .modal-body h6").css("padding-left", "15px");
                    $("#popup_history .modal-dialog .modal-content .modal-body h6").css("padding-top", "20px");
                } else {
                    response.result.map(value => {
                        $("#popup_history .modal-dialog .modal-content .modal-body").append(
                            `<div class="creator_item creator_card space-x-10"><!-- start creator item -->
                            <div class="avatars space-x-10">
                                <div class="media">
                                    <a href="/author/12" class="btn-avatar">
                                        <i class='bx bxs-check-circle'></i>
                                        <img src="../client/img/avatar/12.jpg" alt="Avatar" class="avatar avatar-md">
                                    </a>
                                </div>
                                <div class="bid-accepted">
                                    <p class="color_black">Bid accepted 
                                        <span class="color_brand">${value.price} ETH</span> by <a class="color_black txt_bold" href="/author">${value.nick_name}</a>
                                    </p>
                                    <span class="date color_text">${value.create_date}</span>
                                </div>
                            </div>
                            </div><!-- end creator item -->`
                        );
                    })
                }
            }
        });
    });
    //-------Ajax bid item------//
    $(document).on('click', ".place-bid .price,.place-bid-slider .placebid", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data("url");
        var bid_url = $(this).data("bid-url");

        $.ajax({
            type: "POST",
            url: url,
            data: { dataSearch: id },
            dataType: "json",
            success: function (response) {
                response.result.map(value => {
                    $("#popup_bid .modal-dialog .modal-content .modal-body").html(
                        `<h3>Place a Bid</h3>
                        <div class="d-flex justify-content-between last-child-bid">
                            <p> You must bid at least : </p>
                            <p class="text-right color_black txt _bold"> ${value.price + 1} ETH</p>
                        </div>
                        <div class="input-field-form">
                            <input type="number" class="form-control" data-old-price="${value.price}" placeholder="${value.price + 1} ETH" name="success_price">
                            <div class="show_error"></div>	
                        </div>
                        <div class="hr"></div>
                        <div class="place-bid-btn"><!-- start place btn -->
                            <a href="#" class="btn btn-primary w-full popup-bid-btn" 
                                data-toggle="modal" data-target="#popup_ask_bid"
                                data-dismiss="modal" data-price="" aria-label="Close"> Place bid
                            </a>					
                        </div><!-- end place btn -->`
                    );
                    $(".alert_text_confirm").html(" ");
                    $(".alert_text_confirm").append(`
                    <p class="text-center text_confirm">Are you want to bid ${value.price + 1} ETH for this item ???</p>
                    <div class="d-flex justify-content-around">
                        <button style="padding: 12px 30px; border: none" data-toggle="modal" data-target="#popup_bid_success"
                        data-dismiss="modal" class="btn_placebid success-bid-btn"
                        data-price="${value.price + 1}" data-url="${bid_url}" data-id="${id}">Accept</button>
                        <button style="border-radius: 0.5rem; padding: 12px 30px" class="btn btn-dark" data-dismiss="modal">Deny</button>
                    </div>
                    `);

                    $(document).on('change', "input[name='success_price']", function (e) {
                        e.preventDefault();
                        var price = $(this).val();
                        var old_price = $(this).data("old-price");

                        if (price <= old_price) {
                            $(".show_error").html(`<h5 style="padding: 12px">* Invalid amount</h5>`);
                            $(".alert_text_confirm").html(" ");
                            $(".alert_text_confirm").append(`
                            <h2 class="text-center"> An error occurred !!! </h2>
                            <h5 class="text-center"> Invalid amount </h5>
                            `);
                        } else {
                            $(".alert_text_confirm").html(" ");
                            $(".alert_text_confirm").append(`
                            <p class="text-center text_confirm">Are you want to bid ${price} ETH for this item ???</p>
                            <div class="d-flex justify-content-around">
                                <button style="padding: 12px 30px; border: none" data-toggle="modal" data-target="#popup_bid_success"
                                data-dismiss="modal" class="btn_placebid success-bid-btn"
                                data-price="${price}" data-url="${bid_url}" data-id="${id}">Accept</button>
                                <button style="border-radius: 0.5rem; padding: 12px 30px" class="btn btn-dark" data-dismiss="modal">Deny</button>
                            </div>
                            `);
                        }
                    });
                });
            }
        });
    });

    $(document).on('click', ".success-bid-btn", function (e) {
        e.preventDefault();
        var price = $(this).data("price");
        if (price == null) {
            price = $("input[name='success_price']").val();
        }
        var url = $(this).data("url");
        var id = $(this).data("id");

        $.ajax({
            type: "POST",
            url: url,
            data: { id: id, price: price },
            dataType: "json",
            success: function (response) {
                if (response.result[0].status == 1) {
                    $(".title-bid-success").text("Your Bid Successfuly Added");
                    $(".success_price").text("Your bid " + price + " has been counted.");
                    $(".balance .price").text("Balance: " + response.result[0].points + " ETH");
                    $(".show-price-" + id).text("Unit :" + response.result[0].item_price + " ETH");
                } else {
                    $(".title-bid-success").text("An error occurred !!!");
                    $(".success_price").text("Please check your balance or this items has expired");
                }
            }
        });
    });

    //-------fommat VND------//
    $("input[name='withdraw-eth']").change(function (e) {
        e.preventDefault();
        $('#eth-to-vnd h5').html(($("input[name='withdraw-eth']").val() * 9800).toLocaleString('en-US') + " VND");
    });

    $(document).on('click', ".notify-content", function () {
        $(".notify-menu").slideToggle();
        $(".profile-pop-otr").css("display", "none");
        $(".dot-notify").removeClass("show");

        var url = $(this).data("url");

        $.ajax({
            type: "POST",
            url: url,
        });

    });
});

import { changeTime } from "./module.js";
var time_change = ".text-notify span";
var time_change2 = ".purchage-text-link .purchage-text";
changeTime(time_change2);
changeTime(time_change);





