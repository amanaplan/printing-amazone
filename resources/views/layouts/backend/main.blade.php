<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    
    <head>
        <meta charset="utf-8" />
        <title>@yield('pagetitle') | {{config('app.name')}} Admin</title>
        <meta name="robots" content="noindex, nofollow">
        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link rel="shortcut icon" href="{{ asset( 'assets/images/fabicon.png' ) }}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <!-- WEB FONTS : use %7C instead of | (pipe) -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />
        <!-- CORE CSS -->
        <link href="{{ asset( 'assets/backend/plugins/bootstrap/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'assets/backend/plugins/metis-menu/metisMenu.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'assets/backend/plugins/font-awesome/css/font-awesome.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'assets/backend/plugins/simple-line-icons-master/css/simple-line-icons.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'assets/backend/plugins/animate/animate.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'assets/backend/plugins/c3/c3.min.css' ) }}" rel="stylesheet">
        <link href="{{ asset( 'assets/backend/plugins/widget/widget.css' ) }}" rel="stylesheet">
        <link href="{{ asset( 'assets/backend/plugins/calendar/fullcalendar.min.css' ) }}" rel="stylesheet">
        <link href="{{ asset( 'assets/backend/plugins/ui/jquery-ui.css' ) }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset( 'assets/backend/plugins/toastr/toastr.min.css' ) }}"/>
        <!-- THEME CSS -->
        <link href="{{ asset( 'assets/backend/css/style.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'assets/backend/css/theme/dark.css' ) }}" rel="stylesheet" type="text/css" />
        <!-- PAGE LEVEL SCRIPTS -->

        <style type="text/css">
            .current-menu{color:#fff !important;background-color: #6a717b;}
        </style>

        {{-- page specific --}}
            @stack('styles')
        {{-- page specific --}}
    </head>
    <body class="fixed-top">
        <!-- wrapper -->
        <div id="wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="{{ url('/') }}" target="_blank">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="absolute admin" class="img-responsive logo-default"/> </a>
                    </div><div class="menu-toggler sidebar-toggler">
                        <a href="javascript:;" class="navbar-minimalize minimalize-styl-2  pull-left "><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- END LOGO -->
                    {{-- BEGIN TOP NAVIGATION MENU --}}
                        @include('layouts.backend.headernav')
                    {{-- END TOP NAVIGATION MENU --}}
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <aside class="sidebar">
                    {{-- SIDEBAR --}}
                        @include('layouts.backend.sidebar')
                    {{-- END SIDEBAR --}}
                </aside>
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    
                    {{-- main content --}}
                        @yield('contents')
                    {{-- main content --}}
                    <div class="clearfix"></div>
                    <div class="footer">
                        <div class="pull-right">
                            
                        </div>
                        <div>
                            <strong>Copyright</strong> <a href="{{ url('/') }}" target="_blank">Printing Amazon</a> &copy; {{ date('Y', time()) }}
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTAINER -->
        </div>
        <!-- /wrapper -->
        <!-- SCROLL TO TOP -->
        <a href="#" id="toTop"></a>
        <!-- PRELOADER -->
        <div id="preloader">
            <div class="inner">
                <span class="loader"></span>
            </div>
        </div><!-- /PRELOADER -->
        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript" src="{{ asset( 'assets/backend/plugins/jquery/jquery.min.js' ) }}"></script>
        <script type="text/javascript" src="{{ asset( 'assets/backend/plugins/metis-menu/metisMenu.min.js' ) }}"></script>
        <script type="text/javascript" src="{{ asset( 'assets/backend/plugins/bootstrap/js/bootstrap.min.js' ) }}"></script>
        <script type="text/javascript" src="{{ asset( 'assets/backend/plugins/slim-scroll/jquery.slimscroll.min.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/c3/d3.v3.min.js' ) }}" charset="utf-8"></script>       
        <script src="{{ asset( 'assets/backend/plugins/c3/c3.min.js' ) }}"></script>
        <script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>
        <script src="{{ asset( 'assets/backend/plugins/calendar/moment.min.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/calendar/fullcalendar.min.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/ui/jquery-ui.js' ) }}"></script>       
        <script src="{{ asset( 'assets/backend/plugins/map/jquery-jvectormap-1.2.2.min.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/map/jquery-jvectormap-world-mill-en.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/morris_chart/morris.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/morris_chart/raphael-2.1.0.min.js' ) }}"></script>
        <!-- PAGE LEVEL FILES -->
        <script src="{{ asset( 'assets/backend/plugins/data-tables/jquery.dataTables.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/data-tables/dataTables.tableTools.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/data-tables/dataTables.bootstrap.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/data-tables/dataTables.responsive.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/data-tables/tables-data.js' ) }}"></script>
        <!-- Custom FILES -->
        <script type="text/javascript" src="{{ asset( 'assets/backend/js/custom.js' ) }}"></script>
        <script src="{{ asset( 'assets/backend/plugins/toastr/toastr.min.js' ) }}"></script>

        <script>
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          };

          @if(session()->has('flashmsg'))
            Command: toastr["{{session('flashtype')}}"]("{{ session('flashmsg') }}", "{{ (session('flashtype') == 'success')? 'Successfully Done. .' : 'Error Occurred. .' }}");
          @endif
        </script>

        <script type="text/javascript" src="{{ asset( 'assets/backend/js/index-2.js' ) }}"></script>
        {{-- jquery popup window for elfilnder --}}

        <script type="text/javascript">
            function PopupCenter(url, title, w, h) {
                // Fixes dual-screen position                         Most browsers      Firefox
                var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
                var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

                var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

                var left = ((width / 2) - (w / 2)) + dualScreenLeft;
                var top = ((height / 2) - (h / 2)) + dualScreenTop;
                var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

                // Puts focus on the newWindow
                if (window.focus) {
                    newWindow.focus();
                }
            }

            $(document).ready(function(){
                $('.fileSelector').click(function(){
                    PopupCenter("{{ route( 'elfinder' ) }}", "Select File", 950, 490);
                    id = $(this).attr('elem-id');
                });
            });
            function processFile(file){
                console.log(id);
                $('img#picture_prvw-'+id).attr('src', "{{ asset('assets') }}" +'/'+file['path'].replace(/\\/g,"/"));
                $('#the_img_fld-'+id).val(file['name']);
            }
        </script>
        {{-- page specific --}}
            @stack('scripts')
        {{-- page specific --}}
    </body>
</html>
