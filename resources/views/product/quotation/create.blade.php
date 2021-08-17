@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Quotations Create)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <!--We Can Add There button -->
                <a href="{{ route("quotations.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-list"></i>
                    @translate(Show All Quotations)
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <form target="_blank" action="{{route('quotations.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Name)</label>
                                <div>
                                    <input class="form-control" name="name" value="{{old('name')}}" type="text" required>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Phone Number)</label>
                            <div>
                                <input class="form-control" name="phone" value="{{old('phone')}}" required>
                            </div>
                        </div>
                    </div>



                    <!--Col end-->
                </div>
                <hr>
                <div class="card">
                    <h3 class="card-title p-3">
                        @translate(Product List)</h3>
                    <div class="card-body">
                        <div class="search mb-4">
                            <select class="form-control kt-select2 data " placeholder="Product" id="kt_select2_3" onchange="forSearchQuo()" name="search">
                                <option value="">
                                    @translate(Select Product)</option>
                                @foreach($products as $item)
                                <option value="{{$item->id}}">{{$item->name }}({{$item->code}})</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Discount)</label>
                                <div>
                                    <input class="form-control" name="discount" onchange="totalQuo()" value="" type="number" id="Discount">
                                </div>
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
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-form-label text-md-right">
                            @translate(Description)</label>
                            <div>
                                <textarea class="summernote" id="kt_summernote_1" name="description" placeholder="Place some text here">{{old('description')}}</textarea>
                            </div>
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