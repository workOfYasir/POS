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
<style media="print">
    .noprint{
        display: none;
    }
</style>
<body>
<div class="container">
    <div class="row noprint">
        <div class="col-4">
            <a href="{{route('poses.create')}}">
            <button type="button" class="btn btn-primary">POS</button>
            </a>
        </div>
        <div class="col-4">
           
           
        </div>
        <div class="col-4 ">
            <div class="float-right">
                <a href="{{route('poses.index')}}">
                    <button type="button" class="btn btn-primary">Sales</button>
                    </a>
            </div>
        </div>
    </div>
    @php
    echo $org->header
    @endphp

    <hr class="border border-dark">
     <div class="row">
         <div class="col-4">
            <h4 class="text-capitalize bold">@translate(Invoice ):</h4>
         @if($sales->customer != null)
               <h5>{{$sales->customer->name}}</h5>
               <p>{{$sales->customer->email ?? null}}</p>
               <p>{{$sales->customer->phone ?? null}}</p>
              
             @else
               <h5>N/A</h5>
             @endif
         </div>
         <div class="col-4">
            <div class="kt-aside__brand-logo">
                <a href="{{url('/')}}">
                    <img  alt="Logo" src="{{asset('uploads/org/1615558981.png')}}" width="120"
                         height="auto" style=" margin-left: 20%;">
                </a>
            </div>
         </div>
         <div class="col-4 ">
             <div class="float-right">
                 <h4 class="text-capitalize bold"@translate(Invoice)> INV000{{$sales->id}}</h4>
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
                <th scope="col" class="text-right ">@translate(Tax)</th>
                <th scope="col" class="text-right ">@translate(Total Price)</th>
            </tr>
            </thead>
            <tbody>
                <?php $totalTaxAmount=0;?>
            @foreach($sales->saleProducts as $item)
                <?php 
                    
                    // $taxAmount=$item->unit_price - $item->product->unit_price;
                    // $quantity= $item->quantity;
                    // $totalTaxAmount = ($taxAmount+$totalTaxAmount) * $quantity;
                     $tax=$item->product->tax_id;
                    $totalTaxAmount = $totalTaxAmount + $item->tax_amount;
                ?>
            <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>
                 {{$item->product->name}}
                 
                </td>
                <td>{{$item->quantity}}</td>
                <td class="font-weight-bold text-right">{{formatePrice($item->unit_price)}}</td>
                <td class="font-weight-bold text-right">{{formatePrice($item->tax_amount)}}</td>
                <td class="font-weight-bold text-right">{{formatePrice($item->sub_price)}}</td>
                
            </tr>
            @endforeach
            @if($sales->discount != null)
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td class="font-weight-bold text-right">@translate(Discount)</td>
                <td class="font-weight-bold text-right">{{formatePrice($sales->discount)}}</td>
            </tr>
            @endif
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td class="font-weight-bold text-right">@translate(Total TAX)</td>
                <td class="font-weight-bold text-right">{{formatePrice($totalTaxAmount)}}</td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <td class="font-weight-bold text-right">@translate(Total)</td>
                <td class="font-weight-bold text-right">{{formatePrice($sales->total_price)}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <hr class="border border-dark">
    <div class="col-md-12 ">
        <p>
            In case of any query please contact: contact@madinaventure.pk
        </p> <br>
        <p> Or visit: www.madinaventure.pk</p>
    </div>
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
