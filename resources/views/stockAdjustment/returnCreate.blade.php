@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Sale Show)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
            </div>
        </div>

        <div class="kt-portlet__body">
            <form>
                <div class="">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right"> @translate(Price)</label>
                                <div class="">
                                    <p class="font-weight-bold">{{formatePrice($pos->price)}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Total Price)</label>
                                <div class="">
                                    <p class="font-weight-bold">{{formatePrice($pos->total_price)}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Customer)</label>
                                <div class="">
                                    <p class="font-weight-bold">{{$pos->customer->name ?? 'N/A'}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Created By)</label>
                                <div class="">
                                    <p class="font-weight-bold">{{$pos->user->name ?? 'N/A'}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Created Date)</label>
                                <div class="">
                                    <p class="font-weight-bold">{{date('d-M-y', strtotime($pos->created_at))}}</p>
                                </div>
                            </div>
                        </div>
                        <!--Col end-->
                    </div>
                    <hr>
                    <div class="kt-portlet__body">
                        <h2>@translate(All Product List)</h2>
                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable"
                               id="kt_table_1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@translate(Name)</th>
                                <th>@translate(Quantity)</th>
                                <th class="text-right">@translate(Cost Price)</th>
                                <th class="text-right">@translate(Unit Price)</th>
                                <th class="text-right">@translate(Sub Price)</th>
                                <th class="text-right">@translate(Active)</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pos->saleProducts as $item)
                                <tr>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td class="text-right">{{formatePrice($item->cost_price_total)}}</td>
                                    <td class="text-right">{{formatePrice($item->unit_price)}}</td>
                                    <td class="text-right">{{formatePrice($item->sub_price)}}</td>
                                    <td class="text-right">
                                        <a href="#" onclick="confirm_modal_return('{{route('return.sale.product',$item->id)}}')" class="text-danger nav-link">@translate(return)</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="ml-auto mr-5">
                            <strong class="text-right"> @translate(Total Price): {{formatePrice($pos->total_price)  }}</strong>
                        </div>
                        <!--end: Datatable -->
                    </div>
                    <hr>
                </div>
            </form>
        </div>
    </div>

@endsection
