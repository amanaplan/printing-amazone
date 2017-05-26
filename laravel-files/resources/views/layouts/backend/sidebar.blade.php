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


        <li>
            <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Sample </span><span class="label label-rouded pull-right p3-bg note-icon">10</span></a>
        </li>

        <li class="nav-heading"><span>Components</span></li>

        <li>
            <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Sample </span><span class="label label-rouded pull-right p3-bg note-icon">2</span></a>
        </li>




    </ul>

    <!-- END SIDEBAR MENU -->

    <!-- END SIDEBAR MENU -->

</nav>