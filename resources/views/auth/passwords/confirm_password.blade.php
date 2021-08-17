@extends('admin.master')

@section('content')

    <div class="login-box pt-lg-5">

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('passwords.update') }}">
                        @csrf
                             <input type="hidden" value="{{$user->id}}" name="id">

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
@endsection
