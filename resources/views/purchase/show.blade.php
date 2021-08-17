@extends('admin.master')
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Purchase Show)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <!--We Can Add There button -->
                <a href="{{ route("purchases.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-list"></i>
                    @translate(Show All Purchase)
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
                                @translate(WareHouse)</label>
                                <div>
                                    <p class="font-weight-bold">{{$purchase->warehouse->name}}</p>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Supplier)</label>
                                <div>
                                    <p class="font-weight-bold">{{$purchase->supplier->name}}</p>
                                </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Shipping Cost)</label>
                            <div>
                                <p class="font-weight-bold">{{$purchase->shipping_cost}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Discount)</label>
                                <div>
                                    <p class="font-weight-bold">{{$purchase->discount}}</p>
                                </div>
                        </div>
                    </div>
                    @if($purchase->document != null)
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Document)</label>
                                    <div>
                                        <a href="{{asset('uploads/purchase/'.$purchase->document)}}"></a>
                                    </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">
                                    @translate(Description)</label>
                                    <div>
                                        @php
                                        $purchase->description
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
                            @foreach($purchase->purchaseProducts as $item)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{formatePrice($item->unit_price)}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{formatePrice($item->sub_price)}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="ml-auto mr-5">
                        <strong class="text-right">
                            @translate(Total Price): {{formatePrice($purchase->total_amount) }}</strong>
                    </div>
                    <!--end: Datatable -->
                </div>
                <hr>
                <div class="kt-portlet__body">
                    <h2>
                        @translate(All Payment List)</h2>
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    @translate(Paid)</th>
                                <th>
                                    @translate(Due)</th>
                                <th>
                                    @translate(Date)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1 ?>
                            @foreach($purchase->payments as $item)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{formatePrice($item->paid_amount)}}</td>
                                    <td>{{formatePrice(abs($item->due_amount))}}</td>
                                    <td>{{date('d-M-y', strtotime($item->created_at))}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="ml-auto mr-5">
                        <p class="text-primary"><strong>
                                @translate(Total Amount)</strong> : {{formatePrice($purchase->total_amount)}}</p>
                        <p class="text-success"><strong>
                                @translate(Total Paid)</strong> : {{formatePrice($purchase->total_paid)}}</p>
                        <p class="text-danger"><strong>
                                @translate(Now Due)</strong> : {{formatePrice(abs($purchase->total_due))}}</p>
                    </div>
                    <!--end: Datatable -->
                </div>
                @if($purchase->total_due != 0)
                    <a onclick="forModal('{{ route('purchases.payment.create', $purchase->id) }}', '@translate(Purchase Payment Create)')" class="btn btn-primary  kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-paper-plane text-light"></i>
                        <span class="kt-nav__link-text text-light">
                            @translate(Create Payment)
                        </span>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

@endsection
