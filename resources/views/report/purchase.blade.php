<?php use App\Helper\Helper;$org = Helper::organization()?>
@extends('admin.master')
@section('title')
purchase reports
@endsection
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary">
                @translate(Purchase Report)</h2>
            <div class="card-body">
                <form method="{{route('report.purchase')}}" method="get">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    @translate(Date)</label>
                                    <div>
                                        <div class="input-daterange input-group">
                                            <input type="text" class="form-control" id="kt_datepicker_2" placeholder="@translate(Start Date)" name="start" value="{{Request::get('start')}}" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="@translate(End Date)" id="kt_datepicker_2" name="end" value="{{Request::get('end')}}" />
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label>
                                    @translate(Ware House)</label>
                                <div>
                                    <select class="form-control kt-select2 width-full select" name="warehouse_id">
                                        <option value="">
                                            @translate(Select WareHouse)</option>
                                        @foreach($warehouses as $item)
                                        <option value="{{$item->id}}" {{Request::get('warehouse_id') == $item->id ? 'selected': null}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-group">
                                <label>
                                    @translate(Supplier)</label>
                                    <div>
                                        <select class="form-control kt-select2 width-full select" name="supplier_id">
                                            <option value="">
                                                @translate(Select Supplier)</option>
                                            @foreach($suppliers as $item)
                                            <option value="{{$item->id}}" {{Request::get('supplier_id')  == $item->id ? 'selected': null}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label class="pt-5"></label>
                                <button type="submit" class="btn btn-outline-primary">
                                    @translate(Filter)</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable report" id="kt_table_1">
            <thead>
                <tr>
                    <th>
                        @translate(Serial)</th>
                    <th>
                        @translate(Shipping Cost)</th>
                    <th>
                        @translate(Total Amount)</th>
                    <th>
                        @translate(Total Paid)</th>
                    <th>
                        @translate(Total Due)</th>
                    <th>
                        @translate(Total Discount)</th>
                    <th>
                        @translate(Total Product)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_amounts = 0;
                $total_product = 0;
                $total_shipping_cost = 0;
                $total_paids = 0;
                $total_dues = 0;
                $total_discount = 0;
                ?>

                @foreach($purchases as $item)
                <tr>
                    <td>{{$loop -> index+1}}</td>
                    <td>
                        {{formatePrice($item->shipping_cost)}}
                        <input type="hidden" value="{{$total_shipping_cost += $item->shipping_cost}}">
                    </td>
                    <td>
                        {{formatePrice($item->total_amount)}}
                        <input type="hidden" value="{{$total_amounts += $item->total_amount}}">
                    </td>
                    <td>
                        {{formatePrice($item->total_paid)}}
                        <input type="hidden" value="{{$total_paids += $item->total_paid}}">
                    </td>
                    <td>
                        {{formatePrice(abs($item->total_due))}}
                        <input type="hidden" value="{{$total_dues += $item->total_due}}">
                    </td>
                    <td>
                        {{formatePrice($item->discount)}}
                        <input type="hidden" value="{{$total_discount += $item->discount}}">
                    </td>
                    <td>
                        <?php $q = 0?>
                        @foreach($item->purchaseProducts as $product)
                            <input type="hidden" value="{{$q += $product->quantity}}">
                            @endforeach
                            {{$q}}
                            <input type="hidden" value="{{$total_product += $q}}">
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>
                        @translate(Serial)</th>
                    <th><strong>
                            @translate(Shipping Cost): {{formatePrice($total_shipping_cost)}}</strong></th>
                    <th><strong class="text-primary">
                            @translate(Total
                            Amount): {{formatePrice($total_amounts) }}</strong></th>
                    <th><strong class="text-success">
                            @translate(Total Paid): {{formatePrice($total_paids)}}</strong>
                    </th>
                    <th><strong class="text-danger">
                            @translate(Total Due): {{formatePrice(abs($total_dues))}}</strong>
                    </th>
                    <th><strong class="text-danger">
                            @translate(Total
                            Discount): {{formatePrice($total_discount)}}</strong></th>
                    <th><strong>
                            @translate(Total Product): {{formatePrice($total_product)}}</strong></th>
                </tr>

            </tfoot>
        </table>

        <!--end: Datatable -->
    </div>
</div>

@endsection
