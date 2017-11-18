<nav class="sidebar-nav">

    <ul class="metismenu" id="menu">

        <li>
            <a {!! ($page == 'dashboard')? 'class="current-menu"' : '' !!} href="{{ route('admin.dashboard') }}"><i class="icon-grid"></i> <span class="nav-label">Dashboard</span></a>
        </li>

        @if(Auth::user()->super_admin)

        <li {!! ($page == 'new_admin' || $page == 'manage_admins')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label">Site Admins </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'new_admin')? 'class="current-menu"' : '' !!} href="{{ route('add.new.admin.page') }}">Add New Admin</a></li>
                <li><a {!! ($page == 'manage_admins')? 'class="current-menu"' : '' !!} href="{{ route('manage.admins') }}">Manage Admin Accounts</a></li>
            </ul>
        </li>
        
        @endif

        <li>
            <a {!! ($page == 'customers')? 'class="current-menu"' : '' !!} href="{{ route('manage.customers') }}"><i class="icon-user"></i> <span class="nav-label">Customers</span></a>
        </li>

        <li {!! ($page == 'category_add' || $page == 'category_manage')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Manage Categories </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'category_add')? 'class="current-menu"' : '' !!} href="{{ url('/admin/category/add') }}">Add New Category</a></li>
                <li><a {!! ($page == 'category_manage')? 'class="current-menu"' : '' !!} href="{{ url('/admin/category/manage') }}">Manage Categories</a></li>
            </ul>
        </li>

        <li {!! ($page == 'product_add' || $page == 'product_manage')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-cube"></i> <span class="nav-label">Manage Products </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'product_add')? 'class="current-menu"' : '' !!} href="{{ url('/admin/product/add') }}">Add New Product</a></li>
                <li><a {!! ($page == 'product_manage')? 'class="current-menu"' : '' !!} href="{{ url('/admin/product/manage') }}">Manage Products</a></li>
            </ul>
        </li>

        <li {!! ($page == 'paperstock' || $page == 'size' || $page == 'qty')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Form Field Options </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'paperstock')? 'class="current-menu"' : '' !!} href="{{ url('/admin/form/paperstock') }}">Paperstock options</a></li>
                <li><a {!! ($page == 'size')? 'class="current-menu"' : '' !!} href="{{ url('/admin/form/size') }}">Size (mm<sup>2</sup>) options</a></li>
                <li><a {!! ($page == 'qty')? 'class="current-menu"' : '' !!} href="{{ url('/admin/form/qty') }}">Quantity options</a></li>
                <li><a {!! ($page == 'sticker_type')? 'class="current-menu"' : '' !!} href="{{ url('/admin/form/sticker-type') }}">Sticker Type (name sticker)</a></li>
                <li><a {!! ($page == 'lamination')? 'class="current-menu"' : '' !!} href="{{ url('/admin/form/lamination') }}">Lamination (name sticker)</a></li>
            </ul>
        </li>

        <li {!! ($page == 'review-published' || $page == 'review-unpublished')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-comment"></i> <span class="nav-label">Product Reviews </span>@if($pending_review > 0)<span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_review }} New</span> @endif</a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'review-published')? 'class="current-menu"' : '' !!} href="{{ url('/admin/product/reviews/published') }}">Published Reviews</a></li>
                <li><a {!! ($page == 'review-unpublished')? 'class="current-menu"' : '' !!} href="{{ url('/admin/product/reviews/unpublished') }}">Pending Reviews @if($pending_review > 0)<span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_review }}</span> @endif</a></li>
            </ul>
        </li>

        <li {!! ($page == 'order_complete' || $page == 'order_pending')? 'class="active"' : '' !!}>
            <a href="#"><i class="icon-basket"></i> <span class="nav-label">Orders </span> @if($pending_orders > 0) <span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_orders }}</span> @endif </a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'order_complete')? 'class="current-menu"' : '' !!} href="{{ url('/admin/order/manage/completed') }}">Completed Orders</a></li>
                <li><a {!! ($page == 'order_pending')? 'class="current-menu"' : '' !!} href="{{ url('/admin/order/manage/pending') }}">Pending Orders @if($pending_orders > 0) <span class="label label-success label-rouded pull-right p3-bg note-icon">{{ $pending_orders }}</span> @endif </a></li>
            </ul>
        </li>

        <li {!! ($page == 'page_add' || $page == 'page_manage' || $page == 'footer_links')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="nav-label"> CMS Pages </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'page_add')? 'class="current-menu"' : '' !!} href="{{ url('/admin/cms/add-page') }}">Add Page</a></li>
                <li><a {!! ($page == 'page_manage')? 'class="current-menu"' : '' !!} href="{{ url('/admin/cms/list-pages') }}">Manage Pages </a></li>
                <li><a {!! ($page == 'footer_links')? 'class="current-menu"' : '' !!} href="{{ url('/admin/cms/footer-links') }}">Footer Page Links </a></li>
            </ul>
        </li>

        <li {!! ($page == 'template' || $page == 'template_add')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-download" aria-hidden="true"></i> <span class="nav-label">Downloadable Templates </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'template')? 'class="current-menu"' : '' !!} href="{{ url('/admin/template/manage') }}">Manage Templates</a></li>
                <li><a {!! ($page == 'template_add')? 'class="current-menu"' : '' !!} href="{{ url('/admin/template/add') }}">Add Template </a></li>
            </ul>
        </li>

        <li {!! ($page == 'banner' || $page == 'product_links')? 'class="active"' : '' !!}>
            <a href="#"><i class="fa fa-home" aria-hidden="true"></i> <span class="nav-label"> Manage Home Page </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a {!! ($page == 'banner')? 'class="current-menu"' : '' !!} href="{{ url('/admin/cms/manage-home') }}"> Banner Contents</a></li>
                <li><a {!! ($page == 'product_links')? 'class="current-menu"' : '' !!} href="{{ url('/admin/cms/product-links') }}">Manage Features </a></li>
            </ul>
        </li>

        <li>
            <a {!! ($page == 'notification')? 'class="current-menu"' : '' !!} href="{{ url('/admin/settings/notification') }}"><i class="fa fa-cog"></i> <span class="nav-label">Notification Settings </span></a>
        </li>

        <!-- <li class="nav-heading"><span>Components</span></li>

        <li>
            <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Sample </span><span class="label label-warning label-rouded pull-right p3-bg note-icon">2</span></a>
        </li> -->




    </ul>

    <!-- END SIDEBAR MENU -->

    <!-- END SIDEBAR MENU -->

</nav>
