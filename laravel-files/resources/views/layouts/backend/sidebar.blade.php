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

        <li>

            <a href="#"><i class="icon-basket"></i> <span class="nav-label">Ecommerce</span><span class="fa arrow"></span></a>

            <ul class="nav nav-second-level collapse">                               

                <li><a href="products.html">Product List </a></li>

                <li><a href="orders.html">Orders </a></li>

                <li><a href="order-detail.html">Order Detail </a></li>

                <li><a href="order-invoice.html">Order Invoice </a></li>

            </ul>

        </li>

        <li>

            <a href="widgets.html"><i class="fa fa-cog"></i> <span class="nav-label">Widgets </span><span class="label label-rouded pull-right p3-bg note-icon">New 40+</span></a>



        </li>

        <li>

            <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="fa arrow"></span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="mailbox.html">Inbox</a></li>

                <li><a href="mail_detail.html">Email view</a></li>

                <li><a href="mail_compose.html">Compose email</a></li>

            </ul>

        </li><li class="nav-heading"><span>Components</span></li>

        <li>

            <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span><span class="label label-rouded pull-right p3-bg note-icon">6</span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="flot_charts.html">Flot charts</a></li>

                <li><a href="morris_js.html">Morris.js</a></li>

                <li><a href="chart_js.html">Chart.js</a></li>

                <li><a href="c3.html">C3</a></li>





            </ul>

        </li>



        <li>

            <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Forms</span><span class="fa arrow"></span><span class="label label-rouded pull-right p1-bg note-icon">11</span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="form_basic.html">Basic form</a></li>

                <li><a href="form_advanced.html">Advanced form</a></li>

                <li><a href="form_wizard.html">Wizard form</a></li>

                <li><a href="form_masked.html">Masked form</a></li>

                <li><a href="form_file_upload.html">File upload</a></li>

                <li><a href="file_drop.html">File Dropzone</a></li>

                <li><a href="form_text_editor.html">Text editor</a></li>

                <li><a href="form_inline_edit.html">Inline edit</a></li>

                <li><a href="form_validate.html">Form Validation</a></li>

                <li><a href="form_tinymce.html">Tinymce Editor</a></li>

                <li><a href="form_wysihtml5.html">WYSIHTML5 Editor</a></li>



            </ul>

        </li>

        <li>

            <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Other Pages</span><span class="fa arrow"></span><span class="label label-rouded pull-right p4-bg note-icon">8</span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="lockscreen.html">Lockscreen</a></li>

                <li><a href="login.html">Login</a></li>

                <li><a href="register.html">Register</a></li>

                <li><a href="404.html">404 Page</a></li>

                <li><a href="empty_page.html">Empty page</a></li>

                <li><a href="gallery.html">gallery</a></li>

                <li><a href="price_tables.html">Price tables</a></li>

                <li><a href="page_contact.html">Contact Page</a></li>

            </ul>

        </li>                     



        <li>

            <a href="#"><i class="fa fa-hourglass-o"></i> <span class="nav-label">Icons</span><span class="fa arrow"></span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="icons.html">Icons</a></li>

                <li><a href="weather-icon.html">Weather Icons</a></li>

                <li><a href="themifyicons.html">Themify Icons</a></li>

                <li><a href="linea_arrows.html">Linea Arrows Icons</a></li>

                <li><a href="linea_basic.html">Linea Basic Icons</a></li>                              

            </ul>

        </li>

        <li>

            <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">UI Elements</span><span class="fa arrow"></span><span class="label label-rouded pull-right p2-bg note-icon">16</span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="typography.html">Typography</a></li>

                <li><a href="buttons.html">Buttons</a></li>

                <li><a href="video.html">Video</a></li>

                <li><a href="tabs_panels.html">Panels</a></li>

                <li><a href="tabs.html">Tabs</a></li><li><a href="chat.html">Chat</a></li>

                <li><a href="alert_notifications.html">Alert &amp; notifications</a></li>

                <li><a href="tree_view.html">Tree View</a></li>

                <li><a href="timeline.html">Time Line</a></li>

                <li><a href="progress_bar.html">Progress Bar</a></li>

                <li><a href="sliders.html">OWL Carousel</a></li>

                <li><a href="range_slider.html">Range Slider</a></li>

                <li><a href="alert_popup.html">Alert Popup</a></li>

                <li><a href="accordion.html">Accordion</a></li>

                <li><a href="models.html">Modals Popup</a></li>

                <li><a href="toastr_alert.html">Toastr Alert</a></li>

            </ul>

        </li>



        <li>

            <a href="grid_options.html"><i class="fa fa-laptop"></i> <span class="nav-label">Grid options</span></a>

        </li>

        <li>

            <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Tables</span><span class="fa arrow"></span><span class="label label-rouded pull-right p4-bg note-icon">5</span></a>

            <ul class="nav nav-second-level collapse"><li><a href="table_basic.html">Static Tables</a></li>

                <li><a href="table_data_tables.html">Data Tables</a></li>

                <li><a href="table_responsive.html">Responsive Tables</a></li>

                <li><a href="table_editable.html">Editable Tables</a></li>

                <li><a href="table_jsgrid.html">JSGrid Tables</a></li>



            </ul>

        </li><li class="nav-heading"><span>More</span></li>

        <li>

            <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="user_profile.html">profile</a></li>

                <li><a href="user_list.html">User list</a></li>



            </ul>

        </li>

        <li>

            <a href="#"><i class="fa fa-map-marker"></i> <span class="nav-label">maps</span><span class="fa arrow"></span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="google_maps.html">Google maps</a></li>

                <li><a href="vector_maps.html">Vector Maps</a></li>

            </ul>

        </li>

        <li>

            <a href="#"><i class="fa fa-pencil"></i> <span class="nav-label">Blog</span><span class="fa arrow"></span></a>

            <ul class="nav nav-second-level collapse">

                <li><a href="blog_list.html">Blog list</a></li>

                <li><a href="blog_post.html">Blog post</a></li>

            </ul>

        </li>

        <li><a href="calendar.html"><i class="fa fa-calendar"></i>  <span class="nav-label">Calendar </span></a></li>



        <li>

            <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>

            <ul class="nav nav-second-level collapse">

                <li>

                    <a href="#">Third Level <span class="fa arrow"></span></a>

                    <ul class="nav nav-third-level collapse">

                        <li>

                            <a href="#">Third Level Item</a>

                        </li>

                    </ul>

                </li> <li><a href="#">Second Level Item</a></li>

            </ul>

        </li><li class="nav-heading"><span>Extra</span></li>



    </ul>

    <!-- END SIDEBAR MENU -->

    <!-- END SIDEBAR MENU -->

</nav>