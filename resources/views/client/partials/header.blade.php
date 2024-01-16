<header id="header-area" class="header-transparent sticky">		
    <div class="mobile_menubar">
        <i class='bx bx-menu'></i>
    </div><!-- End Mobile menu  -->			
    <div class="main-menu-area"> <!-- start main menu area -->
        <div class="container container-main-menu">
            <div class="main-menu d-flex align-items-center">
                <div class="logo"> <!-- start logo  -->
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('client/img/logo.png') }}" alt="logo">
                    </a>
                    <a href="/" class="navbar-icon">
                        <img src="{{ asset('client/img/favicon.png') }}" alt="logo">
                    </a>
                </div> <!-- End logo  -->
                <div class="input-main"> <!-- start search bar  -->
                    <input class="input" type="text" placeholder="Search...">
                    <button type="submit">
                        <i class="bx bx-search"></i>
                    </button>			
                </div> <!-- end search bar  -->			
                <div class="menu d-flex"> <!-- start menu  -->
                    <nav class="navigation" id="mobile-menu">
                        <ul class="menu-list list-style-none mb-0"> <!-- start ul  -->
                            <li><a href="/">Home</a></li>
                            <li><a href="{{route('client.explore')}}">Explore</a>
                            <li><a href="{{route('client.author')}}">Authors</a>
                            </li>
                            <li><a href="{{route('client.news')}}">News</a></li>
                        </ul> <!-- end ul  -->
                    </nav> <!-- end nav  -->
                </div><!-- end menu  -->
                @if (Auth::check())
                <div class="action-nav">			
                    <div class="profile-nav-main">
                        <div class="profile-nav" style="margin-left: 20px">
                            <div class="img-otr">
                                @php
                                    $user = DB::table('user_info')->where('id',Auth::user()->id)->get();
                                    $avatar = $user[0]->avatar;
                                @endphp
                                <img class="nav-prof-img" src="{{ asset('uploads/avatar/'.$avatar) }}" alt="Avatar">
                            </div>
                        </div><!-- end profile-nav  -->
                        <div class="profile-pop-otr">
                            <div class="balance-otr">
                                <div class="balance">
                                    <p class="text heading-S" data-user={{Auth::user()->id}}>{{Auth::user()->full_name}}</p>
                                    <p class="price heading-L" data-balance="{{Auth::user()->points}}">Balance: {{Auth::user()->points}} ETH</p>
                                </div>
                                <div class="img-etherem">
                                    <img class="etherem" src="{{ asset('client/img/avatar/ethereum.png') }}" alt="img">
                                </div>
                            </div><!-- end balance  -->
                            <ul class="link-profile-ul">
                                <li class="link-profile-li">
                                    <a href="{{route('client.myaccount')}}" class="link-profile-a heading-SB">My Account</a>
                                </li>
                                <li class="link-profile-li">
                                    <a href="{{route('client.recharge')}}" class="link-profile-a heading-SB">Recharge</a>
                                </li>
                                <li class="link-profile-li">
                                    <a href="{{route('client.withdraw')}}" class="link-profile-a heading-SB">Withdraw</a>
                                </li>
                                <li class="link-profile-li">
                                    <a href="{{route('client.uploadnft')}}" class="link-profile-a heading-SB">Upload NFT</a>
                                </li>
                                <li class="link-profile-li">
                                    <a href="{{route('logout')}}" class="link-profile-a heading-SB">Logout</a>
                                </li>
                            </ul><!-- end ul  -->
                        </div><!-- end profile pop  -->
                    </div><!-- end profile nav  -->
                    <div class="notify" style="margin-left: 10px; height: 40px;">
                        <div data-url="{{route('client.read_nofitication')}}" class="notify-content">
                            <button style="border: none; background: #fff;"><i style="" class="bx bx-bell bell-notify"></i></button>
                        </div>
                        @php
                            $notify = DB::table('notification')->select('notification.*','user_info.nick_name','user_info.avatar')
                            ->join('user_info','notification.owner_id','=','user_info.id')
                            ->where('user_id',Auth::user()->id)->limit(10)->orderBy('create_date','DESC')->get();
                            $count = 0;
                            foreach ($notify as $item) {
                                if ($item->status == 2) {
                                    $count++;
                                }
                            }
                        @endphp
                        @if ($count > 0)
                        <span class="dot-notify show">{{$count}}</span>
                        @else
                        <span class="dot-notify"></span>
                        @endif
                        <div class="notify-menu">
                            <div class="container">
                                <div class="notify-title">
                                    <h5>Notification</h5>
                                </div>
                                {{-- <div class="filter-notify d-flex">
                                    <button id="all-notify" class="btn-notify selected">All notify</button>
                                    <button id="unread-notify" class="btn-notify">Unread notify</button>
                                </div> --}}
                                <div class="notify-menu-content">
                                    <ul class="notify-menu-ul">
                                        @if ($notify->isNotEmpty())
                                            @foreach ($notify as $item)
                                            <li class="notify-menu-li d-flex">
                                                <div style="margin-top: 10px;" class="avatar-notify img-otr">
                                                    @if ($item->owner_id == 1)
                                                        <img src="{{ asset('uploads/avatar/admin.jpg') }}" alt="" >
                                                    @else
                                                        <img src="{{ asset('uploads/avatar/'.$item->avatar) }}" alt="" >
                                                    @endif
                                                </div>
                                                <div class="text-notify">
                                                    @if ($item->owner_id == 1)
                                                    <h6>Admin</h6>
                                                    @else
                                                    <h6>{{$item->nick_name}}</h6>
                                                    @endif
                                                    <p>{{$item->content}}</p>
                                                    <span>{{$item->create_date}}</span>
                                                </div>
                                             </li>
                                            @endforeach
                                            <li class="notify-menu-li text-center">

                                            </li>
                                        @else
                                            <li class="notify-menu-li text-center pt-3">
                                                <h5>No nofitication!!!</h5>
                                            </li>
                                        @endif
                                    </ul><!-- end ul  -->
                                </div><!-- end profile pop  -->
                            </div>
                        </div>
                    </div>
                </div><!-- end action nav  -->
                @else
                <div class="btn-login">
                    <a class="log" href="{{route('login')}}">Login</a>
                </div>
                @endif						
                <!-- Responsive Menu -->
                <div class="mobile-menu mobile-menu-preview"></div>
            </div><!-- end main menu  -->
            <div class="main-menu-icon"> <!-- start mobile menu icon  -->
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </div> <!-- end mobile menu icon  -->
        </div><!-- end container  -->
    </div><!-- end main menu area  -->
</header>