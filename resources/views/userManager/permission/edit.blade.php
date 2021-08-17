@extends('admin.master')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Permission Update
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
                <form action="{{route('permissions.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$permission->id}}" />
                    <div>
                        <div class="form-group row">
                            <label for="name" class="col-lg-4 col-form-label text-md-right">Name</label>

                            <div class="col-lg-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $permission->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                             <label class="col-lg-4 col-form-label text-md-right">Slug</label>
                            <div class="col-lg-6">
                                <input  type="text" class="form-control" value="{{ $permission->slug }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-md-right">Description</label>
                            <div class="mb-3 col-md-6">
                                <textarea class="summernote st-dec" id="kt_summernote_1" name="description" placeholder="Place some text here">@php echo $permission->description @endphp</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-primary m-2" type="submit">Update</button>
                    </div>

                </form>
            </div>
        </div>
@endsection
