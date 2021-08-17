@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(User Show)
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

    <div class="kt-portlet__body row">
        <form>
            <div class="col-6 offset-3">
                <input type="hidden" name="id" value="{{$user->id}}" />
                <div class="center">
                    <div class="form-group row">
                        <label for="name">
                            @translate(Name)</label>
                            <div class="col-lg-6">
                                <span class="font-weight-bold">{{ $user->name}}</span>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="email">
                            @translate(E-Mail Address)</label>

                        <div class="col-lg-6">
                            <span class="font-weight-bold">{{ $user->email}}</span>
                        </div>
                    </div>

                    @if($user->image != null)
                        <div class="form-group row">
                            <label for="email">
                                @translate(Profile Image)</label>

                            <div class="col-lg-6">
                                <img src="{{asset('/uploads/users/'.$user->image)}}" class="img-fluid " width="80" height="auto">
                            </div>
                        </div>

                        @endif

                        <div class="form-group row">
                            <label for="phone">
                                @translate(Phone)</label>

                                <div class="col-lg-6">
                                    <span class="font-weight-bold">{{ $user->phone}}</span>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label>
                                @translate(Groups List)</label>
                            <div class="mb-3 col-md-6">
                                @foreach($user->groups as $item)
                                    <span class="badge badge-success">{{$item->name}}</span>,
                                    @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
