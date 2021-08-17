<?php $org = \App\Helper\Helper::organization()?>
@extends('admin.master')
@section('title')
stock reports
@endsection
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary">
                @translate(Stock Report)</h2>
            <div class="card-body">
                <form method="{{route('report.stock')}}" method="get">
                    <div class="row">

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Ware House)</label>
                                <div>
                                    <select class="form-control kt-select2 width-full select" name="warehouse_id">
                                        <option value="">
                                            @translate(Select Warehouse)</option>
                                        @foreach($warehouses as $item)
                                        <option value="{{$item->id}}" {{Request::get('warehouse_id') == $item->id ? 'selected': null}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Brand)</label>
                                    <div>
                                        <select class="form-control kt-select2 width-full select" name="brand_id">
                                            <option value="">
                                                @translate(Search Brand)</option>
                                            @foreach($brands as $item)
                                            <option value="{{$item->id}}" {{Request::get('brand_id') == $item->id ? 'selected': null}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>

                        <div class="col-ls-3 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Category)</label>
                                    <div>
                                        <select class="form-control kt-select2 width-full select" name="category_id">
                                            <option value="">
                                                @translate(Select Category)</option>
                                            @foreach($categories as $item)
                                            <option value="{{$item->id}}" {{Request::get('category_id') == $item->id ? 'selected': null}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="col-2">

                            <label class="py-3"></label>
                            <button type="submit" class="btn btn-outline-primary btn-block">
                                @translate(Filter)</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable report table-responsive-sm" id="kt_table_1">
            <thead>
                <tr>
                    <th>
                        @translate(Serial)</th>
                    <th>
                        @translate(Product)</th>
                    <th>
                        @translate(Category)</th>
                    <th>
                        @translate(Brand)</th>
                    <th>
                        @translate(WareHouse)</th>
                    <th>
                        @translate(Quantity)</th>
                    <th>
                        @translate(Unit Price)</th>
                    <th>
                        @translate(Total Price)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_amounts =0;
                $total_product = 0;
                $total_shipping_cost = 0;
                $total_paids =0;
                $total_dues =0;
                $total_descount = 0;
                ?>
                @foreach($products as $item)
                <tr>
                    <td>{{$loop -> index+1}}</td>
                    <td>{{$item->product->name }}
                        {{$item->product->code}}</td>
                    <td>{{$item->product->category->name}}</td>
                    <td>{{$item->product->brand->name }}</td>

                    <td>{{$item->warehouse->name}}</td>
                    <td>
                        @if($item->quantity > $item->product->alert_quantity)
                            <p class="text-success">{{$item->quantity}}</p>
                            @else
                            <p class="text-danger">{{$item->quantity}}</p>
                            @endif
                    </td>
                    <td>
                        {{formatePrice($item->product->price)}}
                    </td>
                    <td>
                        {{formatePrice($item->quantity * $item->product->price)}}
                        <input type="hidden" value="{{ $total_amounts +=$item->quantity * $item->product->price}}">
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>
                        @translate(Serial)</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><strong class="text-primary">
                            @translate(Total Amount): {{formatePrice($total_amounts)}}</strong></th>
                </tr>
            </tfoot>
        </table>

        <!--end: Datatable -->
    </div>
</div>

@endsection
