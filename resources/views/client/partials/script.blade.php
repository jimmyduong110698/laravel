<script src="{{ asset('client/js/modernizr-3.8.0.min.js') }}"></script>
<script src="{{ asset('client/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client/js/popper.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.appear.min.js') }}"></script>
<script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.waypoints.min.js') }}"></script> 
<script src="{{ asset('client/js/wow.js') }}"></script>  
<script src="{{ asset('client/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('client/js/count-to.js') }}"></script>
<script src="{{ asset('client/js/macaw-tabs.js') }}"></script>
<script type="module" src="{{ asset('client/js/multi-countdown.js') }}"></script>
<script id="slick_script" src="{{ asset('client/js/slick.min.js') }}"></script>
<script src="{{ asset('client/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ asset('client/js/main.js') }}"></script>
<script type="module" src="{{ asset('client/js/pagination.js') }}"></script>
<script type="module" id="ajax_script" src="{{ asset('client/js/ajax.js') }}"></script>
<script type="module" src="{{ asset('client/js/module.js') }}"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
@if (Auth::check())
<script type="module">
    import { changeTime } from "../client/js/module.js";
    var time_change = ".text-notify span";
    $(document).ready(function () {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;
        var count = $(".dot-notify").text(); 
        if (count == "") {
            count = 0;
        } else {
            count = parseInt(count);
        }
        $(document).on('click', ".notify-content", function () {
            count = 0;
        });
        function reloadNotification() {
            $.ajax({
                type: "POST",
                url: update_nofitication_url,
                data: {user_id: check_id},
                dataType: "json",
                success: function (response) {
                    if (response.result == -1) {
                        $(".dot-notify").addClass("show");
                    } else {
                        $(".dot-notify").addClass("show");
                        response.result.map(value => {
                            $(".notify-menu-ul").append(`
                            <li class="notify-menu-li d-flex">
                            <div style="margin-top: 10px;" class="avatar-notify img-otr">
                                <img src="../uploads/avatar/${value.owner_id == 1 ? 'admin.jpg' :value.avatar}">
                            </div>
                            <div class="text-notify">
                                <h6>${value.owner_id == 1 ? 'Admin' :value.nick_name}</h6>
                                <p>${value.content}</p>
                                <span>${value.create_date}</span>
                            </div>
                            </li>
                            `);
                        });
                    }    
                    changeTime(time_change);
                }
            });
        }
        
        var check_id = '<?php echo Auth::check() ? Auth::user()->id : null ?>';
        var update_nofitication_url = "@php echo route('client.update_nofitication') @endphp";
        const audio = new Audio("../sound/facebook_messenger.mp3");
        $('#test-btn').click(function () {
            audio.play();
        });
    
        var pusher = new Pusher('7efe81a77c1960f3cbf5', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('comment');
        channel.bind('follow', function(data) {
            if (data != null) {
                if (check_id == data.user) {
                    audio.play();
                    $(".notify-menu-ul").html("");
                    count++;
                    $(".dot-notify").text(count);
                    reloadNotification();
                }
            }
        });      
        channel.bind('auction_refund', function(data) {
            if (data != null) {
                var user_points =  "@php echo Auth::user()->points @endphp";
                if (check_id == data.user) {
                    audio.play();
                    $(".balance .price").text("Balance: " + (data.points + parseInt(user_points)) + " ETH");
                    $(".notify-menu-ul").html("");
                    $(".show-price-" + data.item[0].id).text("Unit :" + data.item[0].price + " ETH");
                    count++;
                    $(".dot-notify").text(count);
                    reloadNotification();
                }
            }
        });
        channel.bind('sent_item', function(data) {
            if (data != null) {
                if (check_id == data.notify[0].user_id) {
                    audio.play();
                    $(".notify-menu-ul").html("");
                    count++;
                    $(".dot-notify").text(count);
                    reloadNotification();
                }
            }
        });
        channel.bind('bid_success', function(data) {
            if (data != null) {
                if (check_id == data.user || check_id == data.owner) {
                    if (check_id == data.owner) {
                        $(".balance .price").text("Balance: " + data.points + " ETH");
                    }
                    audio.play();
                    $(".notify-menu-ul").html("");
                    count++;
                    $(".dot-notify").text(count);
                    reloadNotification();
                } 
            }
        });  
        channel.bind('new_product', function(data) {
            if (data != null) {
                for (let i = 0; i < data.array_user.length; i++) {
                    if (check_id == data.array_user[i]) {
                    audio.play();
                    $(".notify-menu-ul").html("");
                    count++;
                    $(".dot-notify").text(count);
                    reloadNotification();
                }
                }
            }
        });          
    });
</script>
@endif

@stack('handlejs')