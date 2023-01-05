<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | <?php echo isset($title) ? $title : 'Custom Page' ?></title>
    <link rel="icon" type="image/x-icon" href="{{asset('web/images/logo.png')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/kartik-v-bootstrap/css/fileinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/kartik-v-bootstrap/themes/explorer-fas/theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('backend/fancy_box/source/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ url('backend/fancy_box/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('backend/fancy_box/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}" />
    <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/sweetalert.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/sweetalert-overrides.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/custom.css')}}">
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('backend/kartik-v-bootstrap/js/plugins/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/kartik-v-bootstrap/js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/kartik-v-bootstrap/js/locales/fr.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/kartik-v-bootstrap/js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/kartik-v-bootstrap/themes/fas/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/kartik-v-bootstrap/themes/explorer-fas/theme.js')}}" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('backend/tooltipster/css/tooltipster.bundle.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('backend/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="https://louisameline.github.io/tooltipster-follower/dist/css/tooltipster-follower.min.css" />
    <script type="text/javascript">
        var token = "{{ csrf_token() }}";
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                        <li class="nav-item">
                            <a href="{{url('users')}}" class="nav-link {{ (Request::segment(1)=='users')?'active':'' }}">
                                <i class="fa fa-user nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('category')}}" class="nav-link  {{ (Request::segment(1)=='category')?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('product')}}" class="nav-link {{ (Request::segment(1)=='product')?'active':'' }}">
                                <i class="fas fa-stream nav-icon"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/logout')}}" class="nav-link">
                                <i class="fas fa-th nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        @yield('content')
    </div>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('backend/dist/js/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('backend/fancy_box/lib/jquery.mousewheel.pack.js?v=3.1.3')}}"></script>
    <script src="{{url('backend/fancy_box/source/jquery.fancybox.pack.js?v=2.1.5')}}"></script>
    <script src="{{url('backend/fancy_box/source/helpers/jquery.fancybox-buttons.js?v=1.0.5')}}"></script>
    <script src="{{url('backend/fancy_box/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7')}}"></script>
    <script src="{{url('backend/fancy_box/source/helpers/jquery.fancybox-media.js?v=1.0.6')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
    <script src="{{asset('backend/dist/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('backend/dist/js/sweetalert-init.js')}}"></script>
    <script src="{{asset('backend/dist/js/bootstrap-notify.js')}}"></script>
    <script src="{{asset('backend/dist/js/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('backend/dist/js/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/tooltipster/js/tooltipster.bundle.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script type="text/javascript" src="https://louisameline.github.io/tooltipster-follower/dist/js/tooltipster-follower.min.js"></script>
    <script type="text/javascript" src="https://louisameline.github.io/tooltipster-discovery/tooltipster-discovery.min.js"></script>
    <script src="{{asset('backend/dist/js/custom.js?v=1.3')}}"></script>
</body>

</html>