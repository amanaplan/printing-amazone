<div class="top-menu">

    <ul class="nav navbar-nav pull-right">

        <!-- BEGIN NOTIFICATION DROPDOWN -->

        <!-- <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                <i class="icon-bell"></i>

                <span class="badge badge-default"> <span class="ring">

                    </span><span class="ring-point">

                    </span> </span>

            </a>

            <ul class="dropdown-menu animated flipInX">

                <li class="external">

                    <h3>

                        <span class="bold">12 pending</span> notifications</h3>

                    <a href="page_user_profile_1.html">view all</a>

                </li>

                <li>  <ul class="dropdown-menu-list scroller" data-handle-color="#637283">

                        <li>

                            <a href="javascript:;">

                                <span class="time">just now</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-success">

                                        <i class="fa fa-plus"></i>

                                    </span> New user registered. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">3 mins</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-danger">

                                        <i class="fa fa-bolt"></i>

                                    </span> Server #12 overloaded. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">10 mins</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-warning">

                                        <i class="fa fa-bell-o"></i>

                                    </span> Server #2 not responding. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">14 hrs</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-info">

                                        <i class="fa fa-bullhorn"></i>

                                    </span> Application error. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">2 days</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-danger">

                                        <i class="fa fa-bolt"></i>

                                    </span> Database overloaded 68%. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">3 days</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-danger">

                                        <i class="fa fa-bolt"></i>

                                    </span> A user IP blocked. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">4 days</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-warning">

                                        <i class="fa fa-bell-o"></i>

                                    </span> Storage Server #4 not responding dfdfdfd. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">5 days</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-info">

                                        <i class="fa fa-bullhorn"></i>

                                    </span> System Error. </span>

                            </a>

                        </li>

                        <li>

                            <a href="javascript:;">

                                <span class="time">9 days</span>

                                <span class="details">

                                    <span class="label label-sm label-icon label-danger">

                                        <i class="fa fa-bolt"></i>

                                    </span> Storage server failed. </span>

                            </a>

                        </li>

                    </ul>

                </li>

            </ul>

        </li> -->

        <!-- END NOTIFICATION DROPDOWN -->


        <li class="dropdown dropdown-user">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">

                <img alt="" class="img-circle" src="{{ (Auth::user()->profile_pic)? asset('assets/images/profile').'/'.Auth::user()->profile_pic : asset('assets/images').'/user.png' }}">



            </a>

            <ul class="dropdown-menu dropdown-menu-default">

                <li>

                    <a href="{{ route('admin.profile') }}">

                        <i class="icon-user"></i> My Profile </a>

                </li>


                <li>

                    <a href="{{ url('/admin/settings/notification') }}">

                        <i class="icon-wrench"></i> Settimgs

                    </a>

                </li>

                <li class="divider"> </li>

                <li>

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                        <i class="icon-key"></i> Log Out </a>

                </li>

            </ul>

        </li>

        <!-- END USER LOGIN DROPDOWN -->

        <!-- BEGIN QUICK SIDEBAR TOGGLER -->

        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

        <li class="dropdown dropdown-quick-sidebar-toggler">

            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                <i class="icon-logout"></i>

            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                {{ csrf_field() }}

            </form>

        </li>

        <!-- END QUICK SIDEBAR TOGGLER -->

    </ul>

    </div>
