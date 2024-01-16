<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0 ">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area">
                    <h2>Welcome to admin page</h2>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <li>
                            <a class="bell_notification_clicker" href="#"> <img
                                    src="{{ asset('administrator/img/icon/bell.svg') }}" alt>
                                <span>04</span>
                            </a>

                            <div class="Menu_NOtification_Wrap">
                                <div class="notification_Header">
                                    <h4>Notifications</h4>
                                </div>
                                <div class="Notification_body">

                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{ asset('administrator/img/staf/2.png') }}" alt></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#">
                                                <h5>Cool Directory </h5>
                                            </a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>

                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{ asset('administrator/img/staf/4.png') }}" alt></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#">
                                                <h5>Awesome packages</h5>
                                            </a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>

                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{ asset('administrator/img/staf/3.png') }}" alt></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#">
                                                <h5>what a packages</h5>
                                            </a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>

                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{ asset('administrator/img/staf/2.png') }}" alt></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#">
                                                <h5>Cool Directory </h5>
                                            </a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>

                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{ asset('administrator/img/staf/4.png') }}" alt></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#">
                                                <h5>Awesome packages</h5>
                                            </a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>

                                    <div class="single_notify d-flex align-items-center">
                                        <div class="notify_thumb">
                                            <a href="#"><img src="{{ asset('administrator/img/staf/3.png') }}" alt></a>
                                        </div>
                                        <div class="notify_content">
                                            <a href="#">
                                                <h5>what a packages</h5>
                                            </a>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="nofity_footer">
                                    <div class="submit_button text-center pt_20">
                                        <a href="#" class="btn_1">See More</a>
                                    </div>
                                </div>
                            </div>

                        </li>
                    </div>
                    <div class="profile_info">
                        <div class="img-otr">
                            @php
                            $user = DB::table('user_info')->where('id',Auth::user()->id)->get();
                            $avatar = $user[0]->avatar;
                            @endphp
                            <img class="nav-prof-img" src="{{ asset('uploads/avatar/'.$avatar) }}" alt="Avatar">
                        </div>
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <h5>{{Auth::user()->full_name}}</h5>
                            </div>
                            <div class="profile_info_details">
                                <a href="{{route('admin.user.my_profile')}}">My Profile</a>
                                <a href="{{route('logout')}}">Log Out </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>