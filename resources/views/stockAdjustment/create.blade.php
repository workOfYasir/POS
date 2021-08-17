@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Stock Adjustment)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!--We Can Add There button -->
                    @can('stock-show')
                        <a href="{{ route("stocks.adjustment.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-list"></i>
                            @translate(Show All Stock Adjustment)
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <form action="{{route('stocks.adjustment.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(WareHouse)</label>
                                <div>
                                    <select class="form-control kt-select2 fromW width-full select" onchange="optionList()" name="warehouse_id" required>
                                        <option value="">
                                            @translate(Select Warehouse)</option>
                                        @foreach($warehouses as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Invoice Number)</label>
                                <div>
                                    <input class="form-control"  name="invoice" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Return Amount)</label>
                                <div>
                                    <input class="form-control" step="0.01" min="1"  name="amount" type="number" >
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card p-2">
                                <h3 class="card-title">@translate(Product List)</h3>
                                <div class="card-body">
                                    <div class="search pb-4">
                                        <select class="form-control kt-select2 data width-full"  id="kt_select2_3" onchange="forStockAdjustment()" name="search">
                                            <option value="">@translate(Select Product)</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ajax-table">
                                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    @translate(Product Name)</th>
                                                <th>
                                                    @translate(Quantity)</th>
                                                <th>
                                                    @translate(Unit Price)</th>
                                                <th>
                                                    @translate(Sub Price)</th>
                                                <th><i class="kt-nav__link-icon flaticon-delete"></i></th>
                                            </tr>
                                            </thead>
                                            <tbody id="productTable">

                                            </tbody>

                                        </table>
                                        <div class="float-right m-lg-5 d-none">
                                            <strong>
                                                <p>
                                                    @translate(Total Price) : <span id="totalPrice">0.0</span>
                                                </p>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-8 col-sm-12 ">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Description)</label>
                                <div>
                                    <textarea class="summernote" id="kt_summernote_1" name="description" placeholder="Place some text here">{{old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!--Col end-->
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
@section('script')
<script>
$(document).ready(function() {
  $selectElement = $('#kt_select2_3').select2({
    placeholder: "Please select Product",
    allowClear: true
  });
});
</script>
@endsection