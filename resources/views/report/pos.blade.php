<?php $org = \App\Helper\Helper::organization()?>
@extends('admin.master')
@section('title')
pos reports
@endsection
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary">
                @translate(Pos Report)</h2>
            <div class="card-body">
                <form method="{{route('report.pos')}}" method="get">
                    <div class="form-group col-6">
                        <label>
                            @translate(Date)</label>
                            <div>
                                <div class="input-daterange input-group" id="">
                                    <input type="text" class="form-control" placeholder="@translate(Start Date)" id="kt_datepicker_2" name="start" value="{{Request::get('start')}}" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="kt_datepicker_2" name="end" placeholder="@translate(End Date)" value="{{Request::get('end')}}" />
                                    <button type="submit" class="btn btn-outline-primary ml-2">
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
                        @translate(Sale By)</th>
                    <th>
                        @translate(Customer)</th>
                    <th>
                        @translate(Item)</th>
                    <th>
                        @translate(Amount)</th>
                    <th>
                        @translate(Discount)</th>
                    <th>
                        @translate(TAX)</th>    
                    <th>
                        @translate(Created At)</th>    
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price =0;
                $total_item = 0;
                $total_discount = 0;
                $total_tax =0;
                ?>

                @foreach($pos as $item)
                <tr>
                    <td>{{$loop -> index+1}}</td>
                    <td>{{$item->user->name}}</td>
                    <td class="text-primary">{{$item->customer->name ?? 'N/A'}}</td>
                    <td>
                        {{$item->total_item }}
                        <input type="hidden" value="{{$total_item += $item->total_item}}">
                    </td>
                    <td>
                        {{formatePrice($item->total_price)}}
                        <input type="hidden" value="{{$total_price += $item->total_price}}">
                    </td>
                    <td>
                        {{formatePrice($item->discount)}}
                        <input type="hidden" value="{{$total_discount += $item->discount}}">
                    </td>
                    <td class="text-primary">{{$item->total_tax ?? 'N/A'}}
                        <input type="hidden" value="{{$total_tax += $item->total_tax}}">   
                    </td>
                    <td>
                        {{$item->created_at}}
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                    
                    <td><strong>
                            @translate(Total Item) : {{$total_item}}</strong></td>
                    <td><strong>
                            @translate(Total Price) : {{formatePrice($total_price)}}</strong></td>
                    <td><strong>
                            @translate(Total Discount) : {{formatePrice($total_discount)}}</strong></td>
                    <td><strong>
                        @translate(Total TAX) : {{formatePrice($total_tax)}}</strong></td>
                    <td></td>            
                </tr>
            </tfoot>
        </table>

        <!--end: Datatable -->
    </div>
</div>

@endsection
