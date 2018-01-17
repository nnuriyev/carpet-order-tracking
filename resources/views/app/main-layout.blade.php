<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nurlan Nuriyev - linkedin.com/in/nurlannuriyev - github.com/nnuriyev">
    <title>Order Tracking System</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @yield('page-styles')

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="background: #EDEDED; border: 0;">
                    <a href="#" class="site_title">
                        {{--<img src="{{asset('assets/images/logo.png')}}" style="width: 90%; max-width: 130px">--}}
                        <h5 style="color: #164578;margin-top: 20px;font-size: 16px;">Order Tracking System</h5>
                    </a>
                </div>

                <div class="clearfix"></div>

                <!-- sidebar menu -->
                @include('app.components.sidebar')
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        @include('app.components.header')
        <!-- /top navigation -->

        <div class="right_col" role="main">
            <!-- page content -->
            @yield('page-content')
            <!-- /page content -->
        </div>

        <!-- footer content -->
        @include('app.components.footer')
        <!-- /footer content -->
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
@yield('page-scripts')
</body>
</html>
