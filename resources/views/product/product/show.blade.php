@extends('admin.master')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Product Show)
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
        <form action="#">
            <div class="">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Type)</label>
                            <div class="">
                                <p class="font-weight-bold">{{$product->type}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Category)</label>
                                <div class="">
                                    <span class="font-weight-bold">{{$product->category->name}}</span>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Brand)</label>
                                <div class="">
                                    <span class="font-weight-bold">{{$product->brand->name}}</span>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Unit)</label>
                                <div class="">
                                    <span class="font-weight-bold">{{$product->unit->name}}</span>

                                </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Code)</label>
                            <div class="">
                                <span class="font-weight-bold">{{$product->code}}</span>
                            </div>
                        </div>
                    </div>

                    @if(env('BARCODE') == "Show")
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Barcode Code)</label>
                                <div class="">
                                    <img src="{{barcode_asset($product->code.'.jpeg')}}" width="80" height="50" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Cost)</label>
                            <div class="">
                                <span class="font-weight-bold">{{$product->cost}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Sale Price)</label>
                            <div class="">
                                <span class="font-weight-bold">{{$product->price}}</span>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Alert Quantity)</label>

                                <span class="font-weight-bold">{{$product->alert_quantity}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Product Image)</label>
                            <div class="">
                            @if($product->image != null)
                                <img src="{{asset('uploads/product/'.$product->image)}}" width="80" height="80" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Tax Type)</label>
                            <div class="">
                                <span class="font-weight-bold">{{$product->tax_type}}</span>
                            </div>
                        </div>
                    </div>
                    @if($product->tax !=null)
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Product Tax)</label>
                                <div class="">
                                    <span class="font-weight-bold">{{$product->tax->name}}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--Col end-->
                </div>
                <hr>
                <span class="font-weight-bold">{{$product->is_published == true ? 'Product Is Published' : "Product Is Not Published"}}</span>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Product Name)</label>
                    <div class="">
                        <span class="font-weight-bold">{{$product->name}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label text-md-right">
                        @translate(Product Description)</label>
                    <div class="">
                        @php
                        echo $product->description
                        @endphp
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>

@endsection
