<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{\App\Helper\Helper::organization()->name ??  'Pos'}} @yield('title') </title>
    <meta name="description" content="{{\App\Helper\Helper::organization()->about ?? 'Pos'}}">
    {{-- css libraries--}}
    <link rel="icon" href="{{asset('uploads/org/'.\App\Helper\Helper::organization()->logo) ?? 'Pos'}}">
    <link href="{{asset('backEnd/css/font.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backEnd/css/buttons.dataTables.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backEnd/css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backEnd/css/select2.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backEnd/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backEnd/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backEnd/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backEnd/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backEnd/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backEnd/css/custom.css') }}" rel="stylesheet">
    {{-- js libraries --}}

    <script src="{{asset('backEnd/js/jquery-3.5.1.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd/js/clear.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd/js/scripts.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="{{asset('backEnd/js/jquery.dataTables.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd/js/dataTables.buttons.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/dataTables.bootstrap4.js" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/jszip.js" type="text/javascript"></script>
    <script src="{{asset('backEnd/js/pdfmake.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/vfs_fonts.js" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/buttons.html5.js" type="text/javascript"></script>
    <script src="{{asset('backEnd/js')}}/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="{{asset('backEnd/js')}}/bootstrap-maxlength.js" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/pages/crud/forms/editors/summernote.js" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/pages/dashboard.js" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/accounting.js" type="text/javascript"></script>
    <script src="{{asset('backEnd')}}/js/app-script.js" type="text/javascript"></script>

    <!-- begin::Global Config(global config for global JS sciprts) -->

</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed">

    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="{{url('/home')}}">
                <img width="80"
                     height="auto" alt="Logo" src="{{asset('uploads/org/'.\App\Helper\Helper::organization()->logo) ?? 'Pos'}}" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="btn btn-sm btn-primary m-2 kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler">
              <i class="flaticon2-back"></i>
            </button>

            <button class="btn btn-sm btn-primary m-2  kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler">
              <i class="flaticon2-setup">
              </i></button>
        </div>
    </div>

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            @include('admin.include.aside')

            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                @include('admin.include.navbar')

                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                        @include('admin.include.error')
                        @yield('content')

                    </div>
                </div>
                @include('admin.include.footer')
            </div>
        </div>
    </div>
    @include('admin.include.delete')
    @include('admin.include.modal')
    @yield('script')
</body>

</html>
