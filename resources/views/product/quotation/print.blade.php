<?php
$org = \App\Helper\Helper::organization();
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{asset('backEnd/css/font.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backEnd')}}/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backEnd/css/custom.css') }}" rel="stylesheet">

    <title>Quotation</title>
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
            <a href="{{route('quotations.index')}}">
            <button type="button" class="btn btn-primary">Quotations</button>
            </a>
        </div>
        <div class="col-4">
           
           
        </div>
        
    </div>
        @php
        echo $org->header
        @endphp
        <hr class="border border-dark">
        <form>
            <div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Name)</label>
                                <div>
                                    <p class="font-weight-bold">{{$quotation->name}}</p>
                                </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <div class="kt-aside__brand-logo">
                                <a href="{{url('/')}}">
                                    <img  alt="Logo" src="{{asset('uploads/org/1615558981.png')}}" width="120"
                                         height="auto" style=" margin-left: 20%;">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 ">
                        <div class="form-group float-right">
                            <label class="col-form-label text-md-right">
                                @translate(Quotation By) </label>
                            <div>
                                <p class="font-weight-bold">{{$quotation->user->name}}</p>
                            </div>
                            <label class="col-form-label text-md-right">
                                @translate(Phone Number)</label>
                            <div>
                                <p class="font-weight-bold">{{$quotation->phone}}</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Description)</label>
                                <div>
                                    @php
                                      echo $quotation->description
                                    @endphp
                                </div>
                        </div>
                    </div>

                    <!--Col end-->
                </div>
                <hr>
                <div class="kt-portlet__body">
                    <h2>
                        @translate(All Product List)</h2>
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    @translate(Name)</th>
                                <th>
                                    @translate(Unit Price)</th>
                                <th>
                                    @translate(Quantity)</th>
                                <th>
                                    @translate(Sub Price)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1 ?>
                            @foreach($quotation->quotationProducts as $item)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->unit_price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->sub_price}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="text-right st-price">
                        <strong class="text-right">
                            <strong class="text-right">
                              
                            @translate(Discount) : {{ $quotation->discount }}</strong>
                            
                    </div>
                    <div class="text-right st-price">
                        <strong class="text-right">
                            <strong class="text-right">
                                @translate(Total Price) : {{ $quotation->total_price }}</strong>
                            
                            
                    </div>
                    <!--end: Datatable -->
                </div>
            </div>
        </form>
        <hr class="border border-dark">
        @php
        echo $org->header
        @endphp
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('backEnd/js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('backEnd/js/popper.js')}}"></script>
    <script src="{{asset('backEnd/js/bootstrap.js')}}"></script>
    <script>
        $(document).ready(function() {
            "use strict"
            window.print();
        });
    </script>
</body>

</html>
