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
    <div class="row">
        @foreach($products as $product)
            <div class="col-6">
                <div class="card p-1 m-1">
                    <img class="card-img-top" src="{{barcode_asset($product->code.'.jpeg')}}" alt="{{$product->name}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
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
