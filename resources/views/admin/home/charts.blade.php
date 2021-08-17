<?php
//Todo::there are the chart calculation
$start_month = \Carbon\Carbon::parse(date('Y-M-d'))->startOfMonth()->toDateTimeString();
$end_month = \Carbon\Carbon::parse(date('Y-M-d'))->endOfMonth()->toDateTimeString();
$start_year = \Carbon\Carbon::parse(date('Y-M-d'))->startOfYear()->toDateTimeString();
$end_year = \Carbon\Carbon::parse(date('Y-M-d'))->endOfYear()->toDateTimeString();

//this is the round chart
$sale_price_month = \App\Model\Sale::whereBetween('created_at',[$start_month,$end_month])->get()->sum('total_price') ?? 0.0;
$purchase_price_month = \App\Model\Purchase::whereBetween('created_at',[$start_month,$end_month])->get()->sum('total_amount') ?? 0.0;
$expense_amount_month = \App\Model\Expense::whereBetween('created_at',[$start_month,$end_month])->get()->sum('amount') ?? 0.0;
$total_month = max(1, $sale_price_month + $purchase_price_month + $expense_amount_month);

//this is year
$sale_price_year = \App\Model\Sale::whereBetween('created_at',[$start_year,$end_year])->get()->sum('total_price') ?? 0.0;
$purchase_price_year = \App\Model\Purchase::whereBetween('created_at',[$start_year,$end_year])->get()->sum('total_amount') ?? 0.0;
$expense_amount_year = \App\Model\Expense::whereBetween('created_at',[$start_year,$end_year])->get()->sum('amount') ?? 0.0;
$total_year = max(1, $sale_price_year + $purchase_price_year + $expense_amount_year);

$months = array();
$labels = array();
for($i = 1 ; $i <= 12; $i++)
{
    $m = date("M",mktime(0,0,0,$i,1,date("Y")));
    array_push($months,$m);
    array_push($labels, date("F",mktime(0,0,0,$i,1,date("Y"))));
    if(date('M') == $m){
        break;
    }
}
$inc =0;
$inc1 =0;
$labels = json_encode($labels);

?>

<script type="text/javascript" src="{{asset('backEnd/js/loader_kt.js')}}"></script>
<script type="text/javascript">
    "use strict"
    $(document).ready(function(){
        drawChartMonth();
        drawChartYear();
        drawChartEveryMonth();
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
                    value: '{{ round(($sale_price_month*100)/$total_month) }}'
                },
                    {
                        label: "@translate(Expense)",
                        value: '{{ round(($expense_amount_month*100)/$total_month) }}'
                    },
                    {
                        label: "@translate(Purchase)",
                        value: '{{ round(($purchase_price_month*100)/$total_month) }}'
                    }
                ],
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger'),
                    KTApp.getStateColor('brand')
                ],
            });

        }

        revenueChangeMonthly();
    }

    function drawChartYear() {

        // Revenue Change.
        var revenueChangeYearly = function() {
            if ($('#chart_div_year').length == 0) {
                return;
            }

            Morris.Donut({
                element: 'chart_div_year',
                data: [{
                    label: "@translate(Sales)",
                    value: '{{ round(($sale_price_year*100)/$total_year) }}'
                },
                    {
                        label: "@translate(Expense)",
                        value: '{{ round(($expense_amount_year*100)/$total_year) }}'
                    },
                    {
                        label: "@translate(Purchase)",
                        value: '{{ round(($purchase_price_year*100)/$total_year) }}'
                    }
                ],
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger'),
                    KTApp.getStateColor('brand')
                ],
            });
        }

        revenueChangeYearly();
    }


    function drawChartEveryMonth() {


        @php
            $data = array();
            foreach($months as $month){
                $start_month = \Carbon\Carbon::parse($month)->startOfMonth()->toDateTimeString();
                $end_month = \Carbon\Carbon::parse($month)->endOfMonth()->toDateTimeString();
                array_push($data, \App\Model\Sale::whereBetween('created_at',[$start_month, $end_month])->get()->sum('total_price'));
            }
            $data = json_encode($data);
        @endphp


        // Bandwidth Charts 1.
        var bandwidthChart1 = function() {
            if ($('#sale_chart_monthly').length == 0) {
                return;
            }

            var ctx = document.getElementById("sale_chart_monthly").getContext("2d");

            var gradient = ctx.createLinearGradient(0, 0, 0, 240);
            gradient.addColorStop(0, Chart.helpers.color('#d1f1ec').alpha(1).rgbString());
            gradient.addColorStop(1, Chart.helpers.color('#d1f1ec').alpha(0.3).rgbString());

            var config = {
                type: 'line',
                data: {
                    labels: {!! $labels !!},
                    datasets: [{
                        label: "Sale ",
                        backgroundColor: gradient,
                        borderColor: KTApp.getStateColor('success'),

                        pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                        pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                        pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                        pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                        //fill: 'start',
                        data: {{$data}}
                    }]
                },
                options: {
                    title: {
                        display: false,
                    },
                    tooltips: {
                        mode: 'nearest',
                        intersect: false,
                        position: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            display: false,
                            gridLines: false,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: false,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    elements: {
                        line: {
                            tension: 0.0000001
                        },
                        point: {
                            radius: 4,
                            borderWidth: 12
                        }
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 10,
                            bottom: 0
                        }
                    }
                }
            };

            var chart = new Chart(ctx, config);
        }
        bandwidthChart1();
    }

</script>

<div class="row">
    <div class="col-lg-12">
        <!--begin:: Monthly/Revenue Change-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
                <div class="kt-widget14__header">
                    <h3 class="kt-widget14__title">
                        @translate(Monthly Chart)
                    </h3>
                    <span class="kt-widget14__desc">
                        {{date('F Y')}}
                    </span>
                </div>
                <div class="kt-widget14__content">
                    <div class="kt-widget14__chart">
                        <div id="chart_div_month" class="st-chart"></div>
                    </div>
                    <div class="kt-widget14__legends">
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__bullet kt-bg-success"></span>
                            <span class="kt-widget14__stats">{{ round(($sale_price_month*100)/$total_month) }}% @translate(Sales)</span>
                        </div>
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__bullet kt-bg-brand"></span>
                            <span class="kt-widget14__stats">{{ round(($purchase_price_month*100)/$total_month) }}% @translate(Purchase)</span>
                        </div>
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__bullet kt-bg-danger"></span>
                            <span class="kt-widget14__stats">{{ round(($expense_amount_month*100)/$total_month) }}% @translate(Expense)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end:: Monthly/Revenue Change-->
    </div>
    <div class="col-lg-12">
        <!--begin:: Yearly/Revenue Change-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
                <div class="kt-widget14__header">
                    <h3 class="kt-widget14__title">
                        @translate(Yearly Chart)
                    </h3>
                    <span class="kt-widget14__desc">
                        {{date('Y')}}
                    </span>
                </div>
                <div class="kt-widget14__content">
                    <div class="kt-widget14__chart">
                        <div id="chart_div_year" class="st-chart"></div>
                    </div>
                    <div class="kt-widget14__legends">
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__bullet kt-bg-success"></span>
                            <span class="kt-widget14__stats">{{ round(($sale_price_month*100)/$total_month) }}% @translate(Sales)</span>
                        </div>
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__bullet kt-bg-brand"></span>
                            <span class="kt-widget14__stats">{{ round(($purchase_price_month*100)/$total_month) }}% @translate(Purchase)</span>
                        </div>
                        <div class="kt-widget14__legend">
                            <span class="kt-widget14__bullet kt-bg-danger"></span>
                            <span class="kt-widget14__stats">{{ round(($expense_amount_month*100)/$total_month) }}% @translate(Expense)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end:: Yearly/Revenue Change-->
    </div>
</div>

<div class="row">
    <div class="col-12">

        <!--begin:: Widgets/Inbound Bandwidth-->
        <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder">
            <div class="kt-portlet__head kt-portlet__space-x">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @translate(Sale Graph)
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget20">
                    <div class="kt-widget20__chart h-100 h-50">
                        <canvas id="sale_chart_monthly"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-space-20"></div>
        <!--end:: Widgets/Inbound Bandwidth-->
    </div>
</div>
