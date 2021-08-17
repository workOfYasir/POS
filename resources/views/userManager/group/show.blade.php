@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Group Show)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!--We Can Add There button -->
                    <a href="{{ route("groups.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-list"></i>
                        @translate(Show All Group)
                    </a>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <form>
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-lg-4 col-form-label text-md-right"> @translate(Name)</label>

                        <div class="col-lg-6">
                            <p class="font-weight-bold">{{ $group->name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-md-right"> @translate(Description)</label>
                        <div class="mb-3 col-md-6">
                            @php
                            echo $group->description
                            @endphp
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-md-right"> @translate(Permission List)</label>
                        <div class="m-3 col-md-6">
                            @foreach($group->permissions as $item)
                                <span class="badge badge-success m-2">{{$item->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
