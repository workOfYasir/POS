@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Stock Transfer Show)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!--We Can Add There button -->
                    <a href="{{ route("stocks.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-list"></i>
                        @translate(Show All Stock Transfer)
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
                                <label class="col-form-label text-md-right">@translate(To WareHouse)</label>
                                <div>
                                    <p class="font-weight-bold">{{$stock->toWarehouse->name}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-10">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(From WareHouse)</label>
                                <div>
                                    <p class="font-weight-bold">{{$stock->fromWarehouse->name}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-10">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Shipping Cost)</label>
                                <div>
                                    <p class="font-weight-bold">{{$stock->shipping_cost}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-10">

                            @if($stock->document != null)
                                <input type="hidden" name="document" value="{{$stock->document}}">
                                <a href="{{asset('uploads/stock/'.$stock->document)}}" class="nav-link" target="_blank">@translate(Document)</a>
                            @endif
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
                                <th>@translate(Quantity)</th>
                                <th>@translate(Sub Price)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $a = 1 ?>
                            @foreach($stock->stockProducts as $item)
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
                        <div class="text-right mr-lg-5">
                            <strong class="text-right"> @translate(Total Price):   {{ formatePrice($stock->total_amount) }}</strong>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
