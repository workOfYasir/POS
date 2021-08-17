@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->
<?php 
use App\Http\Controllers\Pos\PosController;
use App\Model\Tax;
?>
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
                                <label class="col-form-label text-md-right"> @translate(Discount)</label>
                                <div class="">
                                    <p class="font-weight-bold">{{formatePrice($pos->discount) ?? formatePrice(0)}}</p>
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
                                    <p class="font-weight-bold">{{$pos->customre->name ?? 'N/A'}}</p>
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
                        <table class="table table-responsive table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@translate(Name)</th>
                                <th>@translate(Unit Price (W/O TAX))</th>
                                <th>@translate(TAX Type)</th>
                                <th>@translate(TAX %)</th>
                                <th>@translate(Quantity)</th>
                                <th>@translate(TAX Amount)</th>
                                <th class="text-right">@translate(Total Per Product)</th>
                                


                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $totalTax = 0;
                                    $totalUnitPrice = 0;
                                    $unitPriceMulQuant = 0;
                                    $taxRate= 0;
                                    ?>
                            @foreach($pos->saleProducts as $item)
                                <?php 
                                $totalTax = $totalTax + $item->tax_amount;
                                $tax=$item->product->tax_id;
                                $unitPriceMulQuant = $item->product->unit_price   * $item->quantity;
                                // echo $unitPriceMulQuant;
                                $totalUnitPrice  = $totalUnitPrice + $unitPriceMulQuant;
                                if(empty($tax)){
                                    $taxName = "N/A";
                                } else{
                                    $tax_name =" SELECT * FROM `taxes` WHERE `id` = $tax";
                                    $results = DB::select($tax_name);
                                    $taxName =$results[0]->name;
                                    $taxRate  =$results[0]->rate;
                                }
                                
                                ?>
                           
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{formatePrice($item->product->unit_price)}}</td>
                                    <td>{{ $taxName }}</td>
                                    <td>{{ formatePrice($taxRate ?? '0' )}}</td>
                                    
                                    <td>{{$item->quantity}}</td>
                                    @if(empty($item->tax_amount))
                                        
                                     
                                    <td><p>N/A</p></td>    
                                    @else     
                                    <td>{{formatePrice($item->tax_amount)}}</td>
                                    @endif
                                    <td class="text-right">{{formatePrice($item->sub_price)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <strong class="" style=""> @translate(Sub Total					
                                        ): {{formatePrice($totalUnitPrice)  }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <strong class=""> @translate(Total
                                        Tax): {{formatePrice($totalTax)  }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: right;">
                                    <strong class=""> @translate(Receivable Total					
                                        ): {{formatePrice($pos->total_price)  }}</strong>
                                </td>
                            </tr>
                            </tbody>
                            <div class="ml-auto mr-10">
                               
                            </div>
                        </table>
                        
                        <!--end: Datatable -->
                    </div>
                    <hr>
                </div>
            </form>
        </div>
    </div>

@endsection
