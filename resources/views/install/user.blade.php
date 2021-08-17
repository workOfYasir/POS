@extends('install.app')
@section('content')

    <div class="card-body">
        <h3 class="text-lg-center p-3">@translate(Create Admin User)</h3>
        <form method="POST" action="{{ route('admin.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-lg-4 col-form-label text-md-right">@translate(Name)</label>

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
                <label for="email" class="col-lg-4 col-form-label text-md-right">@translate(E-Mail Address)</label>

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
                <label for="phone" class="col-lg-4 col-form-label text-md-right">@translate(Phone)</label>

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

            <div class=>
                <div class="">
                    <button type="submit" class="btn btn-block btn-primary">
                        @translate(Register)
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
