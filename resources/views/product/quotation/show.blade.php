@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Quotation Create)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <!--We Can Add There button -->
                <a href="{{ route("quotations.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-list"></i>
                    @translate(Show All Quotations)
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <form>
            <div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Name)</label>
                                <div>
                                    <p class="font-weight-bold">{{$quotation->name}}</p>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Phone Number)</label>
                            <div>
                                <p class="font-weight-bold">{{$quotation->phone}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Quotation By)</label>
                            <div>
                                <p class="font-weight-bold">{{$quotation->user->name}}</p>
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
                  
                    <div class="text-right m-lg-5">
                        <strong class="text-right">
                            @translate(Discount): {{ formatePrice($quotation->discount)  }}</strong>
                            <strong class="text-right">
                                @translate(Total Price): {{ formatePrice($quotation->total_price)  }}</strong>
                    </div>
                    <!--end: Datatable -->
                </div>
                <div class="float-right">
                    <a href="{{ route('quotations.print', $quotation->id) }}" target="_blank" class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-print"></i>
                        <span class="kt-nav__link-text">
                            @translate(Print)</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
