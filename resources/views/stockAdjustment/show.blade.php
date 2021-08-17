@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Stock Adjustment Details)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!--We Can Add There button -->
                    <a href="{{ route("stocks.adjustment.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-list"></i>
                        @translate(Show All Stock Adjustment)
                    </a>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <form>
                <div>
                    <div class="row">

                        <div class="col-lg-4 col-sm-10">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(WareHouse)</label>
                                <div>
                                    <p class="font-weight-bold">{{$stock->warehouse->name}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-10">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Amount)</label>
                                <div>
                                    <p class="font-weight-bold">{{$stock->amount}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-10">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Description)</label>
                                <div>
                                    @php
                                        echo  $stock->description
                                    @endphp
                                </div>
                            </div>
                        </div>

                        <!--Col end-->
                    </div>
                    <hr>
                    <div class="kt-portlet__body">
                        <h2>@translate(All Product List)</h2>
                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm" id="kt_table_1">
                            <thead>
                            <tr>
                                <th>@translate(Id)</th>
                                <th>@translate(Name)</th>
                                <th>@translate(Unit Price)</th>
                                <th>@translate(Return Quantity)</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $a = 1 ?>
                            @foreach($stock->adjustmentProduct as $item)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{formatePrice($item->product->unit_price)}}</td>
                                    <td>{{$item->quantity}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!--end: Datatable -->
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
