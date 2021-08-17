<?php use App\Helper\Helper;$org = Helper::organization()?>
@extends('admin.master')
@section('title')
warehouse product reports
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="kt-portlet kt-portlet--mobile">
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary">
                @translate(Warehouse Product Report)</h2>
            <div class="card-body">
                <form method="{{route('report.purchase')}}" method="get">
                    <div>
                        <div class="form-group ">
                            <label class="col-form-label text-md-right">
                                @translate(Ware House)</label>
                            <div class="input-group">
                                <select class="form-control kt-select2 width-full col-6 select" name="warehouse_id">
                                    <option value="">
                                        @translate(Select Warehouse)</option>
                                    @foreach($warehouses as $item)
                                    <option value="{{$item->id}}" {{Request::get('warehouse_id') == $item->id ? 'selected': null}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-primary ml-2">
                                    @translate(Filter)
                                </button>
                            </div>

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
                        @translate(Quantity)</th>
                    <th>
                        @translate(Unit Price)</th>
                    <th>
                        @translate(Total Price)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                $total_item = 0;
                $total_descount = 0;
                ?>

                @foreach($products as $item)
                @if($item->product!= null)
                    <tr>
                        <td>{{$loop -> index+1}}</td>
                        <td>
                            {{$item->product->name }}
                        </td>
                        <td>
                            @if($item->quantity > $item->product->alert_quantity)
                                <strong class="text-success">{{$item->quantity}}</strong>
                                @else
                                <strong class="text-danger">{{$item->quantity}}</strong>
                                @endif
                                <input type="hidden" value="{{$total_price +=$item->quantity * $item->product->price}}">
                                <input type="hidden" value="{{$total_item +=$item->quantity}}">
                        </td>
                        <td>{{formatePrice($item->product->price)}} </td>
                        <td>{{formatePrice($item->quantity * $item->product->price)}}</td>

                    </tr>
                    @endif
                    @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>
                            @translate(Total Item) : {{$total_item}}</strong></td>
                    <td></td>
                    <td><strong>
                            @translate(Total Price) :{{formatePrice($total_price)}} </strong></td>
                </tr>
            </tfoot>
        </table>
        <!--end: Datatable -->
    </div>
</div>

@endsection
