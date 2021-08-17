@extends('admin.master')
@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Group Create)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!--We Can Add There button -->
                    <a href="{{ route("groups.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-list"></i>
                        @translate(Show All Groups)
                    </a>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <form action="{{route('groups.store')}}" method="post">
                @csrf
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-lg-4 col-form-label text-md-right"> @translate(Name)</label>

                        <div class="col-lg-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-md-right"> @translate(Description)</label>
                        <div class="mb-3 col-md-6">
                            <textarea class="summernote" id="kt_summernote_1" name="description"
                                      placeholder="Place some text here"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-8 offset-2">
                            <div class="kt-checkbox-inline ">
                                <div class="row">

                                    <div class="col-3 p-2">
                                        <label class="kt-checkbox kt-checkbox--danger">
                                            <input onclick="markAll()" type="checkbox">
                                            @translate(Check all Permission)
                                            <span></span>
                                        </label>
                                    </div>
                                    @foreach($permissions as $item)
                                        <div class="col-3 p-2">
                                            <label class="kt-checkbox kt-checkbox--success">
                                                <input name="permission_id[]" type="checkbox"
                                                       value="{{$item->id}}"> {{$item->name}}
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="float-right">
                    <button class="btn btn-primary" type="submit"> @translate(Save)</button>
                </div>

            </form>
        </div>

    </div>

@endsection
