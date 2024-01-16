<!-- Start Modal Popup -->	

<div class="modal fade popup" id="popup_share" tabindex="-1" role="dialog" aria-hidden="true"><!-- start share btn popup -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3>Share with : </h3>
                <div class="share-btn"><!-- start place btn -->
                    <ul class="share-icon-list">
                        <li class="nav-item">
                            <a href="#" class="share-icon1"><i class='bx bxl-facebook' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon2"><i class='bx bxl-linkedin' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon3"><i class='bx bxl-twitter' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon4"><i class='bx bxl-pinterest-alt' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon5"><i class='bx bxl-google-plus' ></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="share-icon6"><i class='bx bxl-instagram' ></i></a>
                        </li>
                    </ul>
                </div><!-- end share btn -->
            </div><!-- end modal body -->
        </div><!-- end modal content -->
    </div><!-- end modal dialog -->
</div><!-- end  share btn popup -->	
<div class="modal fade popup" id="popup_report_success" tabindex="-1" role="dialog" aria-hidden="true"><!-- start report successful -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3 class="text-center">Your Report Successfuly Counted</h3>
                <p class="text-center">We will have taken against this item after reviewing. Thanks for your support.</p>
                <a href=" " class="btn btn-dark"> Watch More</a>
            </div>
        </div>
    </div>
</div><!-- end report successful -->
<div class="modal fade popup" id="popup_report" tabindex="-1" role="dialog" aria-hidden="true"><!-- start report input popup -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3>Copyright Claim Against :</h3>
                <div class="input-field-form">
                    <input type="text" class="form-control" placeholder="Explain behind the reason">			
                </div>
                <div class="hr"></div>
                <div class="place-bid-btn"><!-- start place btn -->
                    <a href="#" class="btn btn-primary w-full popup-bid-btn" 
                        data-toggle="modal" data-target="#popup_report_success" 
                        data-dismiss="modal" aria-label="Close"> Submit Report
                    </a>					
                </div><!-- end place btn -->
            </div><!-- end modal body -->
        </div><!-- end modal content -->
    </div><!-- end modal dialog -->
</div><!-- end report input popup -->	
<div class="modal fade popup" id="popup_bid_success" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid successful -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3 class="text-center title-bid-success">Your Bid Successfuly Added</h3>
                <p class="text-center success_price"></p>
                <a href="#" data-dismiss="modal"
                aria-label="Close" class="btn btn-dark"> Watch More</a>
            </div>
        </div>
    </div>
</div><!-- end bid successful -->
<div class="modal fade popup" id="popup_bid" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid input popup -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                
            </div><!-- end modal body -->
        </div><!-- end modal content -->
    </div><!-- end modal dialog -->
</div><!-- end bid input popup -->
{{-- <div class="modal fade popup" id="popup_history" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid history --> --}}
<div class="modal fade popup" id="popup_history" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid history -->
    <div class="modal-dialog modal-dialog-centered" role="document"><!-- start modal-dialog -->

        <div class="modal-content"><!-- start modal-content -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40"><!-- start modal-body -->
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end bid history -->	

{{-- alert-bid --}}
<div class="modal fade popup" id="popup_bid_alert" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid successful -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40">
                <h3 class="text-center"><i style="transform: translateY(2px)" class='bx bxs-error'></i>Error !!!</h3>
                <p class="text-center">You must log in to continue.</p>
                <a href="{{route('login')}}" class="btn btn-dark">Login now</a>
            </div>
        </div>
    </div>
</div><!-- alert-bid -->

{{-- ask_to_bid --}}
<div class="modal fade popup" id="popup_ask_bid" tabindex="-1" role="dialog" aria-hidden="true"><!-- start bid successful -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body space-y-20 p-40 alert_text_confirm">
                
            </div>
        </div>
    </div>
</div><!-- ask_to_bid -->

<!-- End Modal Popup -->	