<nav class="sidebar-nav">

    <ul class="metismenu" id="menu">

        <li>
            <a {!! ($page == 'dashboard')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ route('admin.dashboard') }}"><i class="icon-grid"></i> <span class="nav-label">Dashboard</span></a>
        </li>

        @if(Auth::user()->super_admin)

        <li {!! ($page == 'new_admin' || $page == 'manage_admins')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label">Site Admins </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'new_admin')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ route('add.new.admin.page') }}">Add New Admin</a></li>
                <li><a {!! ($page == 'manage_admins')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ route('manage.admins') }}">Manage Admin Accounts</a></li>
            </ul>
        </li>
        
        @endif

        <li {!! ($page == 'category_add' || $page == 'category_manage')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Manage Categories </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'category_add')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/category/add') }}">Add New Category</a></li>
                <li><a {!! ($page == 'category_manage')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/category/manage') }}">Manage Categories</a></li>
            </ul>
        </li>

        <li {!! ($page == 'product_add' || $page == 'product_manage')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-cube"></i> <span class="nav-label">Manage Products </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'product_add')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/product/add') }}">Add New Product</a></li>
                <li><a {!! ($page == 'product_manage')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/product/manage') }}">Manage Products</a></li>
            </ul>
        </li>

        <li {!! ($page == 'paperstock' || $page == 'size' || $page == 'qty')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Form Field Options </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'paperstock')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/form/paperstock') }}">Paperstock options</a></li>
                <li><a {!! ($page == 'size')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/form/size') }}">Size (mm<sup>2</sup>) options</a></li>
                <li><a {!! ($page == 'qty')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/form/qty') }}">Quantity options</a></li>
                <li><a {!! ($page == 'sticker_type')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/form/sticker-type') }}">Sticker Type (name sticker)</a></li>
                <li><a {!! ($page == 'lamination')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/form/lamination') }}">Lamination (name sticker)</a></li>
            </ul>
        </li>

        <li {!! ($page == 'review-published' || $page == 'review-unpublished')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-comment"></i> <span class="nav-label">Product Reviews </span>@if($pending_review > 0)<span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_review }} New</span> @endif</a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'review-published')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/product/reviews/published') }}">Published Reviews</a></li>
                <li><a {!! ($page == 'review-unpublished')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/product/reviews/unpublished') }}">Pending Reviews @if($pending_review > 0)<span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_review }}</span> @endif</a></li>
            </ul>
        </li>

        <li {!! ($page == 'order_complete' || $page == 'order_pending')? 'class="active"' : '' !!}>
            <a href="#"><i class="icon-basket"></i> <span class="nav-label">Orders </span> @if($pending_orders > 0) <span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_orders }}</span> @endif </a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'order_complete')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/order/manage/completed') }}">Completed Orders</a></li>
                <li><a {!! ($page == 'order_pending')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/order/manage/pending') }}">Pending Orders @if($pending_orders > 0) <span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_orders }}</span> @endif </a></li>
            </ul>
        </li>

        <li>
            <a {!! ($page == 'notification')? 'style="color:#fff;background-color: #6a717b;"' : '' !!} href="{{ url('/admin/settings/notification') }}"><i class="fa fa-cog"></i> <span class="nav-label">Notification Settings </span></a>
        </li>

        <li class="nav-heading"><span>Components</span></li>

        <li>
            <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Sample </span><span class="label label-warning label-rouded pull-right p3-bg note-icon">2</span></a>
        </li>




    </ul>

    <!-- END SIDEBAR MENU -->

    <!-- END SIDEBAR MENU -->

</nav>
