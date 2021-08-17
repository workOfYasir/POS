<?php
$org = \App\Helper\Helper::organization();
?>
<html>
<title>@translate(Invoice)</title>
<head>
    <link href="{{asset('backEnd/css/font.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backEnd')}}/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backEnd/css/custom.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    @php
        echo $org->header;
    $previews_customer_id = 0;
    $new_customer = false;
    @endphp

    <hr class="border border-dark">
    @foreach($sales as $sale)
        <div class="row">
            <div class="col-4">
                @if($sale->customer != null)
                    <span
                        class="d-none">{{$previews_customer_id == $sale->customer->id ? $new_customer = true : $new_customer = false}}</span>
                    @if(!$new_customer)
                        <h4 class="text-capitalize bold">@translate(Invoice To):</h4>
                        <span class="d-none">{{$previews_customer_id = $sale->customer->id}}</span>
                        <h5>{{$sale->customer->name}}</h5>
                        <p>{{$sale->customer->email ?? null}}</p>
                        <p>{{$sale->customer->phone ?? null}}</p>
                    @endif
                @else
                    <h5>N/A</h5>
                @endif
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <div class="float-right">
                    <h4 class="text-capitalize bold" @translate(Invoice)> INV000{{$sale->id}}</h4>
                    <h5>Date : {{date('d-M-y')}}</h5>
                </div>
            </div>
        </div>
        <hr>
        <div class="card m-4">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@translate(Product Name)</th>
                    <th scope="col">@translate(Quantity)</th>
                    <th scope="col" class="text-right ">@translate(Unit Price)</th>
                    <th scope="col" class="text-right ">@translate(Total Price)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sale->saleProducts as $item)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>
                            {{$item->product->name}}
                        </td>
                        <td>{{$item->quantity}}</td>
                        <td class="font-weight-bold text-right">{{formatePrice($item->unit_price)}}</td>
                        <td class="font-weight-bold text-right">{{formatePrice($item->sub_price)}}</td>
                    </tr>
                @endforeach
                @if($sale->discount != null)
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td class="font-weight-bold text-right">@translate(Discount)</td>
                        <td class="font-weight-bold text-right">{{formatePrice($sale->discount)}}</td>
                    </tr>
                @endif
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td class="font-weight-bold text-right">@translate(Total)</td>
                    <td class="font-weight-bold text-right">{{formatePrice($sale->total_price)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    @endforeach
    <hr class="border border-dark">
    @php
        echo $org->footer
    @endphp
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('backEnd/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('backEnd/js/popper.js')}}"></script>
<script src="{{asset('backEnd/js/bootstrap.js')}}"></script>
<script>
    $(document).ready(function () {
        "use strict"
        window.print();
    })
</script>
</body>
</html>
