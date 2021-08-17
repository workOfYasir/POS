@extends('admin.master')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Permission Create
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!--We Can Add There button -->
                    <a href="{{ route("permissions.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-list"></i>
                        Show All Permission
                    </a>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <form>
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-lg-4 col-form-label text-md-right">Name</label>

                        <div class="col-lg-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ $permission->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-md-right">Slug</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{ $permission->slug }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-md-right">Description</label>
                        <div class="mb-3 col-md-6">
                            @php
                                echo $permission->description
                            @endphp
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
