<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="{{asset('backEnd/css/font.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('backEnd/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('backEnd/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('backEnd/css/font-awesome.css') }}" type="text/css" />
        <link href="{{asset('backEnd/css/custom.css') }}" rel="stylesheet">
        <script src="{{asset('backEnd/js/jquery-3.5.1.js')}}" type="text/javascript"></script>
        <script src="{{asset('backEnd/js/clear.js')}}" type="text/javascript"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
    </head>
    <body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right
        kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed
        kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
        <div class="container">
            <div class="col-8 offset-2 ">
                <div class="mt-5">
                    <div class="card mt-lg-5 p-3">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
