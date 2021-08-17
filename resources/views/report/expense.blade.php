<?php $org = \App\Helper\Helper::organization()?>
@extends('admin.master')
@section('title')
expense report
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="kt-portlet kt-portlet--mobile">
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary">
                @translate(Expense Report)</h2>
            <div class="card-body">
                <form method="{{route('report.expense')}}" method="get">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    @translate(Date)</label>
                                    <div>
                                        <div class="input-daterange input-group" id="">
                                            <input type="text" class="form-control" id="kt_datepicker_2" placeholder="@translate(Start Date)" name="start" value="{{Request::get('start')}}" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="kt_datepicker_2" name="end" placeholder="@translate(End Date)" value="{{Request::get('end')}}" />
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>
                                    @translate(Category)</label>
                                    <select class="form-control kt-select2 width-full select" name="category_id">
                                        <option value="">
                                            @translate(Select Category)</option>
                                        @foreach($categories as $item)
                                        <option value="{{$item->id}}" {{Request::get('category_id') == $item->id ? 'selected': null}}>{{$item->name}}({{$item->code}})</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>
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
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div>
                                <label class="py-2"></label>
                                <button type="submit" class="btn btn-outline-primary btn-block">
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
        <table class="table table-striped- table-bordered table-hover table-checkable report table-responsive-sm" id="kt_table_1">
            <thead>
                <tr>
                    <th>
                        @translate(Serial)</th>
                    <th>
                        @translate(WareHouse)</th>
                    <th>
                        @translate(Category)</th>
                    <th>
                        @translate(Note)</th>
                    <th>
                        @translate(Amount)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price =0;
                $total_item = 0;
                $total_descount = 0;
                ?>

                @foreach($expenses as $item)
                <tr>
                    <td>{{$loop -> index+1}}</td>
                    <td>
                        {{$item->warehouse->name }}
                    </td>
                    <td>
                        @translate(Name): {{$item->category->name }}<br>
                        @translate(Code): {{$item->category->code }}
                    </td>
                    <td>{{$item->description}}</td>
                    <td>
                        {{formatePrice($item->amount)}}
                        <input type="hidden" value="{{$total_price += $item->amount}}">
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>
                            @translate(Total Price) : {{formatePrice($total_price)}}</strong></td>
                </tr>
            </tfoot>
        </table>

        <!--end: Datatable -->
    </div>
</div>

@endsection
