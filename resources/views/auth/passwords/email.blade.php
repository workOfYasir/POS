<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @translate(Log in)</title>
    <!-- Tell the browser to be responsive to screen width -->
    <link href="{{asset('backEnd/css/font.css')}}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset("backEnd")}}/css/pages/login/login-4.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("backEnd")}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("backEnd")}}/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!-- Google Font: Source Sans Pro -->
</head>

<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        @if($message = \Illuminate\Support\Facades\Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @endif
                        <div class="kt-login__signin">
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group ">
                                        <label for="email" class="text-md-right">
                                            @translate(E-Mail Address)</label>

                                        <div class="">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group  mb-0">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary">
                                                @translate(Send Password Reset Link)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.login-box -->


</body>

</html>
