<?php
$org = \App\Helper\Helper::organization();
?>
<html>
<title>@translate(Invoice)</title>
<head>
    <link href="{{asset('backEnd/css/font.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backEnd')}}/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backEnd/css/custom.css') }}" rel="stylesheet">
    <script src="{{asset('backEnd/js/jquery-3.5.1.js')}}" type="text/javascript"></script>
    <script src="{{asset('backEnd/js/clear.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="container">
    @php
    echo $org->header
    @endphp
    <hr class="border border-dark">
     <div class="row">
         <div class="col-4">
            <h4 class="text-capitalize bold">@translate(Invoice To):</h4>
         @if($sales->customer != null)
               <h5>{{$sales->customer->name}}</h5>
               <p>{{$sales->customer->email ?? null}}</p>
               <p>{{$sales->customer->phone ?? null}}</p>
             @else
               <h5>N/A</h5>
             @endif
         </div>
         <div class="col-4"></div>
         <div class="col-4">
             <div class="float-right">
                 <h4 class="text-capitalize bold">@translate(Invoice) INV000{{$sales->id}}</h4>
                 <h5>Date : {{date('d-M-y')}}</h5>
             </div>

         </div>
     </div>
    <hr>
    <div class="card m-4">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@translate(Product Name)</th>
                <th scope="col">@translate(Quantity)</th>
                <th scope="col">@translate(Unit Price)</th>
                <th scope="col">@translate(Total Price)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales->saleProducts as $item)
            <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>

          {{$item->product->name}}
                </td>
                <td>{{$item->quantity}}</td>
                <td class="font-weight-bold">{{$org->align == 0 ? $org->symbol.  $item->unit_price  :  $item->unit_price   .$org->symbol  }}</td>
                <td class="font-weight-bold">{{$org->align == 0 ? $org->symbol.   $item->sub_price  :  $item->sub_price   .$org->symbol  }}</td>
            </tr>
            @endforeach
            @if($sales->discount != null)
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td class="font-weight-bold">@translate(Discount)</td>
                <td class="font-weight-bold">{{$org->align == 0 ? $org->symbol.  $sales->discount  : $sales->discount   .$org->symbol  }}</td>
            </tr>
            @endif
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td class="font-weight-bold">@translate(Total)</td>
                <td class="font-weight-bold">{{$org->align == 0 ? $org->symbol.  $sales->total_price  : $sales->total_price   .$org->symbol  }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <hr class="border border-dark">
    @php
        echo $org->footer
    @endphp
</div>
<script src="{{asset('/backEnd')}}/js/jquery-3.5.1.js" type="text/javascript"></script>
<script src="{{asset('/backEnd')}}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="{{asset('/backEnd')}}/js/scripts.bundle.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        "use strict"
        window.print();
    });

</script>
</body>
</html>
