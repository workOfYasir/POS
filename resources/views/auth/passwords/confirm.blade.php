<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{asset('backEnd/css/font.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset("backEnd")}}/css/pages/login/login-4.css" rel="stylesheet" type="text/css" />

    <link href="{{asset("backEnd")}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("backEnd")}}/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!-- Google Font: Source Sans Pro -->
    <script src="{{asset('backEnd/js/jquery-3.5.1.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd/js/clear.js')}}" type="text/javascript"></script>
    <script src="{{asset("backEnd")}}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="{{asset("backEnd")}}/js/scripts.bundle.js" type="text/javascript"></script>
    <script src="{{asset("backEnd")}}/js/pages/custom/login/login-general.js" type="text/javascript"></script>

</head>

<body  class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading"  >


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
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">@translate(Password Update)</h3>
                        </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="password" class="col-lg-4 col-form-label text-md-right">@translate(Password)</label>

                        <div class="col-lg-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-lg-4 col-form-label text-md-right">@translate(Confirm Password)</label>

                        <div class="col-lg-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-lg-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                @translate(Confirm Password)
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
</body>
</html>

