<?php

use App\Helper\Helper;

$total_due = 0.00;
$total_paid = 0.00;
$total_amount = 0.00;
?>

<div class="col-xl-6 col-sm-12 col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(All Due Purchase Report)
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_widget11_tab1_content">

                    <div class="kt-widget11">
                        <div class="table-responsive">
                            <table class="table report2">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            @translate(Supplier)</td>
                                        <td>
                                            @translate(Date)</td>
                                        <td>
                                            @translate(Total)</td>
                                        <td>
                                            @translate(Paid)</td>
                                        <td>
                                            @translate(Due)</td>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchases as $item)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$item->supplier->name}}</td>
                                        <td>{{date('d-M-y',strtotime($item->created_at))}}</td>
                                        <td class="text-primary">{{formatePrice($item->total_amount)}}
                                            <input type="hidden" value="{{$total_amount +=$item->total_amount}}">
                                        </td>
                                        <td class="text-success">{{formatePrice($item->total_paid)}}
                                            <input type="hidden" value="{{$total_paid +=$item->total_paid}}"></td>
                                        <td class="text-danger">{{formatePrice(abs($item->total_due))}}
                                            <input type="hidden" value="{{$total_due +=$item->total_due}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-sm-12 col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid ">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Latest Updates)
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
            <div class="kt-widget4 kt-widget4--sticky">
                <div class="kt-widget4__items kt-portlet__space-x kt-margin-t-15">
                    <div class="kt-widget4__item">
                        <span class="kt-widget4__icon">
                            <i class="flaticon2-graphic  kt-font-brand"></i>
                        </span>
                        <a href="{{route('purchases.index')}}" class="kt-widget4__title">
                            @translate(Purchase Total Amount)
                        </a>
                        <span class="kt-widget4__number kt-font-brand">{{formatePrice($total_amount)}}</span>
                    </div>
                    <div class="kt-widget4__item">
                        <span class="kt-widget4__icon">
                            <i class="flaticon2-analytics-2  kt-font-success"></i>
                        </span>
                        <a href="{{route('purchases.index')}}" class="kt-widget4__title">
                            @translate(Purchase Total Paid)
                        </a>
                        <span class="kt-widget4__number kt-font-success">{{formatePrice($total_paid)}}</span>
                    </div>
                    <div class="kt-widget4__item">
                        <span class="kt-widget4__icon">
                            <i class="flaticon2-drop  kt-font-danger"></i>
                        </span>
                        <a href="{{route('purchases.index')}}" class="kt-widget4__title">
                            @translate(Total Purchase Due)
                        </a>
                        <span class="kt-widget4__number kt-font-danger">{{formatePrice(abs($total_due))}}</span>
                    </div>
                    <div class="kt-widget4__item">
                        <span class="kt-widget4__icon">
                            <i class="flaticon2-pie-chart-4 kt-font-warning"></i>
                        </span>
                        <a href="javascript:void()" class="kt-widget4__title">
                            @translate(Total Sale Amount)
                        </a>
                        <span class="kt-widget4__number kt-font-warning">{{formatePrice(abs($total_sale))}}</span>
                    </div>
                </div>
                <div class="kt-widget4__chart kt-margin-t-15">
                    <canvas id="kt_chart_latest_updates height-150"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
