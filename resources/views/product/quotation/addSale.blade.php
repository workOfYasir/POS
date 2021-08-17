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
        <form action="{{route('sale.store')}}" method="post"  >
            @csrf
            <div>
                <div class="row">
                    @if($customer = Session::get('customer'))
                    <div class="col-lg-10 col-sm-12">
                        <div class="form-group">
                            <input type="text" readonly
                                   value="{{$customer->name}} ({{$customer->number}})"
                                   class="form-control" required>
                            <input type="hidden" name="customer_id" readonly
                                   value="{{$customer->id}}">
                        </div>
                    </div>
                @else
                    <div class="col-lg-10 col-sm-12">
                        <div class="form-group">
                            <select class="form-control  customer width-full" id="customer"
                                    name="customer_id" style="opcity:1 !important;">
                                <option value="0">@translate(Select Customer)</option>
                                @foreach($customers as $item)
                                    <option value="{{$item->id}}">{{$item->name }}
                                        ({{$item->number}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Name)</label>
                                <div>
                                    <input class="form-group" name="name" readonly value="{{$quotation->name}}" />
                                    {{-- <p class="font-weight-bold">{{$quotation->name}}</p> --}}
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Phone Number)</label>
                            <div>
                                <input class="form-group" name="phone" readonly value="{{$quotation->phone}}" />
                                {{-- <p class="font-weight-bold">{{$quotation->phone}}</p> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label text-md-right">
                                @translate(Quotation By)</label>
                            <div>
                                <input class="form-group" name="username" readonly value="{{$quotation->user->name}}" />
                                {{-- <p class="font-weight-bold">{{$quotation->user->name}}</p> --}}
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
                            <?php $a = 1; 
                            $totalTax= 0;
                            ?>
                            
                            @foreach($quotation->quotationProducts as $item)
                                <?php
                                $tax=  $item->product->price - $item->product->unit_price;
                                $totalTax= $totalTax + $tax;
                                ?>
                                <tr>
                                    
                                    <td>{{$a++}}</td>
                                    <td> 
                                        <input class="form-group" type="hidden" name="product_id[]" readonly value="{{$item->product->id}}" />
                                        <input class="form-group" type="hidden" name="totalTax" readonly value="{{ $totalTax}}" />
                                        <input class="form-group" type="hidden" name="cost" readonly value="{{$item->product->cost}}" />
                                        @foreach($product as $row)
                                            <input class="form-group" type="hidden" name="warehouse[]" readonly value="{{ $row->warehouse_id }}" />
                                        @endforeach
                                        
                                         <input class="form-group" name="productName" readonly value="{{$item->product->name}}" />
                                     </td> <td>
                                        <input class="form-group" name="unit_price[]" readonly value="{{$item->unit_price}}" />
                                    </td> <td>
                                        <input class="form-group" name="quantity[]" readonly value="{{$item->quantity}}" />
                                    </td> <td>
                                    <input class="form-group" name="sub_price[]" readonly value="{{$item->sub_price}}" />
                                     </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                  
                    <div class="text-right m-lg-5">
                        <strong class="text-right">
                            @translate(Discount): {{ formatePrice($quotation->discount)  }} </strong>
                            <input class="form-group" type="hidden" name="discount" readonly value="{{$quotation->discount}} " />
                            <strong class="text-right">
                                @translate(Total Price): {{ formatePrice($quotation->total_price)  }}</strong>
                                <input class="form-group" type="hidden" name="total_price" readonly value="{{$quotation->total_price}} " />
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
            <div class="col-6">
                <button class="btn btn-block btn-primary save" type="submit">@translate(Submit)</button>
               </div>
        </form>
    </div>
</div>

@endsection
