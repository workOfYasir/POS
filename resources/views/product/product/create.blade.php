@extends('admin.master')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Product Create)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                @can('product-show')
                <a href="{{ route("products.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-list"></i>
                    @translate(Show All Product)
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="row">
                    <input type="hidden" name="type" value="Standard">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Select Category)</label>
                            <div class="">
                                <select class="form-control kt-select2 width-full select" id="" name="category_id" required>
                                    <option value="">@translate(Select Category)</option>
                                    @foreach($categories as $item)
                                    <option value="{{$item->id}}" {{old('category_id') == $item->id ? 'selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Select Brand)</label>
                            <div class="">
                                <select class="form-control kt-select2 width-full select" id="" name="brand_id" required>
                                    <option value="">@translate(Select Brand)</option>
                                    @foreach($brands as $item)
                                    <option value="{{$item->id}}" {{old('brand_id') == $item->id ? 'selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Select Unit)</label>
                            <div class="">
                                <select class="form-control kt-select2 width-full select" id="kt_select2_3" name="unit_id" required>
                                    <option value=""> @translate(Select Unit)</option>
                                    @foreach($units as $item)
                                    <option value="{{$item->id}}" {{old('unit_id') == $item->id ? 'selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if(env('BARCODE') == "Show")
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">@translate(Barcode Code)</label>
                            <small>@translate(If you blank this field, Barcode generated auto)</small>
                            <div class="">
                                <input class="form-control" name="code" value="{{old('code')}}">
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Cost)</label>
                            <div class="">
                                <input step="0.01" class="form-control" min="0" name="cost" value="{{old('cost')}}" type="number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Sale Price)</label>
                            <div class="">
                                <input step="0.01" class="form-control" name="price" value="{{old('price')}}" min="0" type="number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Alert Quantity)</label>
                            <div class="">
                                <input class="form-control" step="0.01" value="{{old('alert_quantity')}}" name="alert_quantity" min="0" type="number">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Image)</label>
                            <div class="custom-file">
                                <input class="custom-file-input" id="customFile" name="image" type="file" required>
                                <label class="custom-file-label">
                                    @translate(Choose File)</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Tax Type)</label>
                            <div class="">
                                <select class="form-control kt-select2 w-100 select" onchange="taxType()" id="tax-type" name="tax_type">
                                    <option value="Inclusive">
                                        @translate(Inclusive)</option>
                                    <option value="Exclusive">
                                        @translate(Exclusive)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 invisible " id="taxs">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Tax)</label>
                            <div class="">
                                <select class="form-control kt-select2 width-full select" name="tax_id">
                                    <option value="">
                                        @translate(Select Tax)</option>
                                    @foreach($taxes as $item)
                                    <option value="{{$item->id}}" {{old('tax_id') == $item->id ? 'selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--Col end-->
                </div>
                <hr>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" checked id="is_published" name="is_published">
                    <label class="form-check-label" for="is_published">
                        @translate(Is Published)</label>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Product Name)</label>
                    <div class="">
                        <input class="form-control" value="{{old('name')}}" name="name" type="text" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Product Description)</label>
                    <div class="">
                        <textarea class="summernote" id="kt_summernote_1" name="description">{{old('description')}}</textarea>
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
