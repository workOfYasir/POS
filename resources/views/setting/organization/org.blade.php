@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Organization Setup)
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <form action="{{route('org.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Organization Name)</label>
                    <div>
                        <input class="form-control" value="{{$org->name}}" name="name" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Organization Email)</label>
                    <div>
                        <input class="form-control" value="{{$org->email}}" name="email" type="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Organization Phone)</label>
                    <div>
                        <input class="form-control" value="{{$org->phone}}" name="phone" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Currency Symbol)</label>
                    <div>
                        <input class="form-control" value="{{$org->symbol}}" name="symbol" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Currency Style)</label>
                    <div>
                        <select class="form-control" name="align">
                            <option value="0" {{$org->align == 0 ? 'selected':null}}>{{$org->symbol}} 100</option>
                            <option value="1" {{$org->align == 1 ? 'selected':null}}>100 {{$org->symbol}}</option>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Logo)</label>
                        <div>
                            <input class="form-control-file" name="newLogo" type="file">
                        </div>
                </div>
                <hr />
                @if($org->logo != null)
                    <input type="hidden" name="logo" value="{{$org->logo}}">
                    <img width="80"
                         height="auto" src="{{asset('uploads/org/'.$org->logo)}}" class="img-thumbnail" alt="Logo">
                    @endif

                    <div class="form-group">
                        <label class="col-form-label text-md-right">
                            @translate(Invoice Header)</label>
                        <div>
                            <textarea class="summernote st-dec" id="kt_summernote_1" name="header" placeholder="Place some text here">@php echo $org->header @endphp</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-md-right">
                            @translate(Invoice Footer)</label>
                        <div>
                            <textarea class="summernote st-dec" id="kt_summernote_1" name="footer" placeholder="Place some text here">@php echo $org->footer @endphp</textarea>
                        </div>
                    </div>
                    <hr>

            </div>
            <div class="float-right">
                <button class="btn btn-primary float-right" type="submit">
                    @translate(Update)</button>
            </div>

        </form>
    </div>
</div>

@endsection
