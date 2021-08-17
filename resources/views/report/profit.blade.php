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
                    @translate(Profit / Loss Report)</h2>
                <div class="card-body">
                    <form method="{{route('report.profit.loss')}}" method="get">
                        <div class="row">
                            <div class="form-group col-8">
                                <label>
                                    @translate(Date)</label>
                                <div class="input-daterange input-group">
                                    <input type="text" class="form-control" id="kt_datepicker_2" name="start" value="{{Request::get('start')}}" placeholder="@translate(Start Date)" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="end" id="kt_datepicker_2" value="{{Request::get('end')}}" placeholder="@translate(End Date)" />
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
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <strong class="text-info">{{date('d-M-y',strtotime($start))}} To {{date('d-M-y',strtotime($end))}}</strong>

                        <hr>
                        <h5>
                            @translate(Total Sale) : <strong>{{formatePrice($sale_total_amount) }}</strong></h5>
                        <h5>
                            @translate(Total Product Cost) : <strong>{{formatePrice($total_product_cost_price)}}</strong></h5>
                        <hr>

                        <h5>
                            @translate(Total Return Sale Amount) : <strong>{{formatePrice($return_sale)}}</strong></h5>
                        <hr>
                        <h5>
                            @translate(Gross Profit) : {{formatePrice($process)}}</h5>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!--Load the AJAX API-->
                    <script type="text/javascript" src="{{asset('backEnd/js/loader_kt.js')}}"></script>
                    <script type="text/javascript">
                        "use strict"
                        $(document).ready(function() {

                            drawChartMonth();
                        });

                        function drawChartMonth() {

                            // Revenue Change Monthly.

                            var revenueChangeMonthly = function() {
                                if ($('#chart_div_month').length == 0) {
                                    return;
                                }

                                Morris.Donut({
                                    element: 'chart_div_month',
                                    data: [{
                                        label: "@translate(Sales)",
                                        value: '{{$sale_total_amount}}'
                                    },
                                        {
                                            label: "@translate(Cost)",
                                            value: '{{ $total_product_cost_price }}'
                                        },
                                        {
                                            label: "@translate(Return Amount)",
                                            value: '{{ $return_sale }}'
                                        },
                                        {
                                            label: "@translate(Gross Profit)",
                                            value: '{{ $process }}'
                                        }
                                    ],
                                    colors: [
                                        KTApp.getStateColor('success'),
                                        KTApp.getStateColor('danger'),
                                        KTApp.getStateColor('warning'),
                                        KTApp.getStateColor('brand')
                                    ],
                                });

                            }

                            revenueChangeMonthly();
                        }
                    </script>
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-widget14">
                            <div class="kt-widget14__header">
                                <h3 class="kt-widget14__title">
                                    @translate(Chart)
                                </h3>
                                <span class="kt-widget14__desc">
                                {{date('d-M-y',strtotime($start))}} To {{date('d-M-y',strtotime($end))}}
                            </span>
                            </div>
                            <div class="kt-widget14__content">
                                <div class="kt-widget14__chart">
                                    <div id="chart_div_month" class="height-150 w-50"></div>
                                </div>
                                <div class="kt-widget14__legends">
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-success"></span>
                                        <span class="kt-widget14__stats">{{ $sale_total_amount }}
                                        @translate(Sales)</span>
                                    </div>
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-brand"></span>
                                        <span class="kt-widget14__stats">{{ $total_product_cost_price }}
                                        @translate(Cost)</span>
                                    </div>
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-warning"></span>
                                        <span class="kt-widget14__stats">{{ $return_sale }}
                                        @translate(Return Amount)</span>
                                    </div>
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-danger"></span>
                                        <span class="kt-widget14__stats">{{ $process }}
                                        @translate(Gross Profit)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--end: Datatable -->
        </div>
    </div>

@endsection
