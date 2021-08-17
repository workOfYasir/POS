@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(User Create)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <!--We Can Add There button -->
                <a href="{{ route("users.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-list"></i>
                    @translate(Show All User)
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="form-group row">
                    <label for="name" class="col-lg-4 col-form-label text-md-right">
                        @translate(Name)</label>

                        <div class="col-lg-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-lg-4 col-form-label text-md-right">
                        @translate(E-Mail Address)</label>

                    <div class="col-lg-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-lg-4 col-form-label text-md-right">
                        @translate(Phone)</label>

                        <div class="col-lg-6">
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-lg-4 col-form-label text-md-right">
                        @translate(Profile Image)</label>

                    <div class="col-lg-6">
                        <input id="image" type="file" class="form-control-file" name="image">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-lg-4 col-form-label text-md-right">
                        @translate(Password)</label>

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
                    <label for="password-confirm" class="col-lg-4 col-form-label text-md-right">
                        @translate(Confirm Password)</label>

                    <div class="col-lg-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label text-md-right">
                        @translate(Select Groups)</label>
                    <div class="col-lg-6">
                        <select class="form-control kt-select2 w-100" id="kt_select2_3" name="group_id[]" multiple required>
                            @foreach($groups as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="float-right">
                <button class="btn btn-primary float-right" type="submit">
                    @translate(Save)</button>
            </div>

        </form>
    </div>
</div>

@endsection
