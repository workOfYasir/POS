@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Purchase Create)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <!--We Can Add There button -->
                <a href="{{ route("purchases.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-list"></i>
                    @translate(Show All Purchase)
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <form action="{{route('purchases.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Select WareHouse)</label>
                            <div>
                                <select class="form-control kt-select2 width-full select" id="" name="warehouse_id" aria-required="true" required>
                                    <option value="">
                                        @translate(Select Warehouse)</option>
                                    @foreach($warehouses as $item)
                                    <option value="{{$item->id}}" {{old('warehouse_id') == $item->id ? 'Selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Select Supplier)</label>
                            <div>
                                <select class="form-control kt-select2 width-full select" id="" name="supplier_id" aria-required="true" required>
                                    <option value="">
                                        @translate(Select Supplier)</option>
                                    @foreach($suppliers as $item)
                                    <option value="{{$item->id}}" {{old('supplier_id') == $item->id ? 'Selected' : null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="card">
                            <h3 class="card-title p-2">
                                @translate(Product List)</h3>
                            <div class="card-body">
                                <div class="search mb-4">
                                    <select class="form-control kt-select2 data width-full" id="kt_select2_3" onchange="forSearchPur()" name="search">
                                        <option value="">
                                            @translate(Select Product)</option>
                                        @foreach($products as $item)
                                        <option value="{{$item->id}}">{{$item->name }}({{$item->code}})</option>
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
                                    <div class="float-right m-lg-5">
                                        <strong>
                                            <p>
                                                @translate(Total Price) : <span id="totalPrice">0.0</span></p>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Shipping Cost)</label>
                            <div>
                                <input class="form-control" min="0" value="{{old('shipping_cost')}}" step="0.01" placeholder="@translate(Shipping Cost)" name="shipping_cost" type="number">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Discount) </label>
                            <div>
                                <input class="form-control" min="0" value="{{old('discount')}}" step="0.01" placeholder="@translate(Discount)" name="discount" type="number">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Paid Amount) </label>
                            <div>
                                <input step="0.01" class="form-control" min="0" name="paid" value="{{old('paid')}}" type="number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Document)</label>
                                <div>
                                    <input class="form-control-file" name="document" type="file">
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
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