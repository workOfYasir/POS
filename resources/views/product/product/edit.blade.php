@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Product Update)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <!--We Can Add There button -->
                <a href="{{ route("products.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-list"></i>
                    @translate(Show All Product)
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <form action="{{route('products.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="id">
            <div class="">
                <input type="hidden" name="type" value="Standard">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Select Category)</label>
                            <div class="">
                                <select class="form-control kt-select2 width-full  select2 select" name="category_id" required>
                                    @foreach($categories as $item)
                                    <option value="{{$item->id}}" {{$product->category->id == $item->id ? 'selected' : null}}>{{$item->name}}</option>
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
                                <select class="form-control kt-select2 width-full  select2 select" name="brand_id" required>
                                    @foreach($brands as $item)
                                    <option value="{{$item->id}}" {{$product->brand->id == $item->id ? 'selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 ">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Select Unit)</label>
                            <div class="">
                                <select class="form-control kt-select2 width-full  select2 select" name="unit_id" required>

                                    @foreach($units as $item)
                                    <option value="{{$item->id}}" {{$product->unit->id == $item->id ? 'selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    @if(env('BARCODE') == "Show")
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Barcode Code)</label>
                                <div class="">
                                    <input class="form-control" readonly value="{{$product->code}}">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Cost)</label>
                            <div class="">
                                <input class="form-control" min="0" step="0.01" name="cost" value="{{$product->cost}}" type="number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Sale Price)</label>
                            <div class="">
                                <input class="form-control" step="0.01" min="0" name="price" value="{{$product->unit_price}}" type="number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Alert Quantity)</label>
                            <div class="">
                                <input class="form-control" min="0" step="0.01" name="alert_quantity" value="{{$product->alert_quantity}}" type="number">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label text-md-right">
                                        @translate(Product Image)</label>
                                    <div class="">
                                        <input class="form-control-file" name="newImage" type="file">
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <input type="hidden" name="image" value="{{$product->image}}">
                                <div class="m-2">
                                    @if($product->image != null)
                                        <img src="{{asset('uploads/product/'.$product->image)}}" width="100" height="auto" class="img-thumbnail">
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Tax Type)</label>
                            <div class="">
                                <select class="form-control kt-select2 width-full" onchange="taxType()" id="tax-type" name="tax_type">
                                    <option value="Exclusive" {{$product->tax_type == "Exclusive" ? 'selected' : null}}>
                                        @translate(Exclusive)
                                    </option>
                                    <option value="Inclusive" {{$product->tax_type == "Inclusive" ? 'selected' : null}}>
                                        @translate(Inclusive)
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @if($product->tax_id !=null)
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Product Tax)</label>
                                <div class="">
                                    <select class="form-control kt-select2 width-full select2 select" name="tax_id">
                                        <option></option>
                                        @foreach($taxes as $item)
                                        <option value="{{$item->id}}" {{$product->tax->id == $item->id ? 'selected' : null}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-4 invisible " id="taxs">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Product Tax)</label>
                                <div class="">
                                    <select class="form-control kt-select2 width-full" name="tax_id">
                                        @foreach($taxes as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!--Col end-->
                </div>
                <hr>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" {{$product->is_published == true ? 'checked' : null}} id="is_published" name="is_published">
                    <label class="form-check-label" for="is_published">
                        @translate(Is Published)</label>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Product Name)</label>
                    <div class="">
                        <input class="form-control" name="name" type="text" value="{{$product->name}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Product Description)</label>
                    <div class="">
                        <textarea class="summernote" id="kt_summernote_1" name="description" placeholder="Place some text here">{{$product->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="float-right">
                <button class="btn btn-primary float-right" type="submit">
                    @translate(Update)</button>
            </div>

        </form>
    </div>
</div>

@endsection
