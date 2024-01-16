import { setCountdown } from "./multi-countdown.js";

function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = seconds / 31536000;

    if (interval > 1) {
        return Math.floor(interval) + " years";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
        return Math.floor(interval) + " months";
    }
    interval = seconds / 86400;
    if (interval > 1) {
        return Math.floor(interval) + " days";
    }
    interval = seconds / 3600;
    if (interval > 1) {
        return Math.floor(interval) + " hours";
    }
    interval = seconds / 60;
    if (interval > 1) {
        return Math.floor(interval) + " minutes";
    }
    return Math.floor(seconds) + " seconds";
}

function changeTime(element) {
    $(element).each(function () {
        var a = new Date(Date.parse($(this).text()));
        a = timeSince(a);
        $(this).text(a + ' ago');
    });
};

let id_interval = [];

function CountdownToTime(element) {
    // Set the date we're counting down to
    let index = 0;
    $(element).each(function () {
        index++;
        let extraClass = 'p_' + index;

        if (new Date($(this).data('date')) > new Date()) {
            $(this).addClass(extraClass);
        }
        let x = setInterval(function () {

            let date = $("." + extraClass).data('date');
            let countDownDate = new Date(date).getTime();
            let url = $("." + extraClass).data('url');
            let id = $("." + extraClass).data('id');
            var check_auth = $("#check_auth").val();

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            $("." + extraClass).html(days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ");

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                $("#clear").trigger('click');
                $("." + extraClass).html("EXPIRED");
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        console.log(response.result);
                        $(".item-code-" + id).html("");
                        $(".item-code-" + id).append(`
                        <div class="single_product mt-50 pb-30"> <!-- Single Product -->
                        <div class="jumbotron countdown show" data-Date='${response.result.end_date}' data-beginDate='${response.result.begin_date}' data-endText="Auction ended">					
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
                            <a href="{{route('client.detail',['id' => $item->id])}}" class="theme_preview_link">
                                <img src="../uploads/item/${response.result.image}" alt="" class="responsive-fluid" />						
                            </a>
                        </div> <!-- End single product img -->
                        <div class="nft_product_description"><!-- start product description -->
                            <div class="nft_product_text">				
                                <ul class="author-profile-link"><!-- start author-->								
                                    <li class="nav-item">									
                                        <a href="author-details.html" class="author_link">
                                            <img src="../uploads/avatar/${response.result.avatar}" alt="author" class="responsive-fluid img-2" />
                                            <i class='bx bxs-check-circle'></i>
                                        </a>	
                                        <span class="hover_author_link">
                                            <a href="#" class="author_link_text">${response.result.nick_name}</a>
                                        </span>								
                                    </li>
                                </ul>	
                            </div><!-- end author-->																		
                            <div class="product_title_link"><!-- start product title-->			
                                <a class="product-title" href="{{route('client.detail',['id' => $item->id])}}">
                                    <h6 class="product_title_intro">${response.result.name}</h6>	
                                </a>								
                            </div><!-- end product title-->		
                        </div><!-- end product text -->
                        <div class="nft_product_link"><!-- start product link -->					
                            <ul>
                                <li class="product-all-icon">
                                    <span class="item-history product-icon">											
                                        <a href="#" class="item-history-btn" data-toggle="modal" data-target="#popup_history" data-url="/bid_history" data-id="${response.result.id}">
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
                                                <span class="sale-counter show-price-${response.result.id}">Unit: ${response.result.price} ETH</span>	
                                        </span>	
                                    </li>										
                            </ul>
                        </div><!-- end product link -->		
                        <div class="place-bid"><!-- start place bid -->
                            <a href="#" class="placebid price" data-toggle="modal" data-target=${check_auth === "true" ? "#popup_bid" : "#popup_bid_alert"}
                            data-bid-url="/bid_success" data-url="/bid_now" data-id="${response.result.id}">Bid Now</a>
                        </div><!-- end place bid -->					
                        </div><!-- end Single Product -->
                        `);
                        setCountdown();
                    }
                });
            }
        }, 1000);

        id_interval.push(x);
    });
}




export { changeTime, CountdownToTime };