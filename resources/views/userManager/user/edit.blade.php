@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(User Update)
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
        <form action="{{route('users.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}" />
            <div>
                <div class="form-group row">
                    <label for="name" class="col-lg-4 col-form-label text-md-right">
                        @translate(Name)</label>

                        <div class="col-lg-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name}}" required autocomplete="name" autofocus>

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
                        <input id="email" type="text" readonly class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}" required autocomplete="email">

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
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>
                <div class="row m-2">
                    <div class="col-4 offset-4">
                        @if($user->image != null)
                            <img src="{{asset('/uploads/users/'.$user->image)}}" class="img-fluid " width="80" height="auto">
                            @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="image" class="col-lg-4 col-form-label text-md-right">
                        @translate(Profile Image)</label>

                    <div class="col-lg-6">
                        <input type="hidden" name="image" value="{{$user->image}}">
                        <input id="image" type="file" class="form-control-file" name="newImage">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label text-md-right">
                        @translate(Select Groups) </label>
                    <div class="col-lg-6">
                        <select class="form-control kt-select2 w-100" id="kt_select2_3" name="group_id[]" multiple required>
                            @foreach($groupss as $item)
                            <option value="{{$item->id}}" @foreach($user->groups as $item1)
                                {{$item1->id == $item->id ? 'selected' : null}}
                                @endforeach
                                >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="float-right">
                <button class="btn btn-primary m-2" type="submit">
                    @translate(Update)</button>
            </div>
        </form>
    </div>
</div>

@endsection
