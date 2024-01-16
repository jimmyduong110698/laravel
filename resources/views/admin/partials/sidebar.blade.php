<nav class="sidebar">
    <div class="logo"> <!-- start logo  -->
        <a href="/" class="navbar-brand">
            <img src="{{ asset('client/img/logo.png') }}" alt="logo">
        </a>
    </div> <!-- End logo  -->
    <ul id="sidebar_menu">
        <li>
            <a href="{{route('admin.dashboard')}}">

                <img src="{{ asset('administrator/img/menu-icon/dashboard.svg') }}" alt>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a class="has-arrow" aria-expanded="false">
                <img src="{{ asset('administrator/img/menu-icon/4.svg') }}" alt>
                <span>Items</span>
            </a>
            <ul>
                <li><a href="{{route('admin.item.items_list')}}">List Items</a></li>
                <li><a href="{{route('admin.item.create_item')}}">Create Item</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin.bid.bids_list')}}">
                <img src="{{ asset('administrator/img/menu-icon/4.svg') }}" alt>
                <span>Bids List</span>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="{{ asset('administrator/img/menu-icon/8.svg') }}" alt>
                <span>Transaction history</span>
            </a>
            <ul>
                <li><a href="{{route('admin.transaction.recharge_list')}}">Recharge</a></li>
                <li><a href="{{route('admin.transaction.withdraw_list')}}">Withdraw</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="#" aria-expanded="false">

                <img src="{{ asset('administrator/img/menu-icon/7.svg') }}" alt>
                <span>Users</span>
            </a>
            <ul>
                <li><a href="{{route('admin.user.index')}}">List Users</a></li>
                <li><a href="{{route('admin.user.create')}}">Create User</a></li>
            </ul>
        </li>
    </ul>
    </li>
    </ul>
</nav>