<?php $org = \App\Helper\Helper::organization()?>
@extends('admin.master')
@section('title')

@endsection
@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary">
                @translate(Book Report)</h2>
            <div class="card-body">
                <form method="{{route('report.pos')}}" method="get">
                    <div class="form-group col-6">
                        <label>
                            @translate(Date)</label>
                            <div>
                                <div class="input-daterange input-group" id="">
                                    <input type="text" class="form-control" placeholder="@translate(Start Date)" id="kt_datepicker_2" name="start" value="{{Request::get('start')}}" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="kt_datepicker_2" name="end" placeholder="@translate(End Date)" value="{{Request::get('end')}}" />
                                    <button type="submit" class="btn btn-outline-primary ml-2">
                                        @translate(Filter)</button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body" style="overflow-x: auto;">
        <!--begin: Datatable -->
        <table  id="kt_table_1" class="table table-striped- table-bordered table-hover table-checkable report " style="overflow-y: true; " >
            <thead>
                <tr>
                    <th>
                        @translate(Date)</th>
                    <th>
                        @translate(Trx No.)</th>
                    <th>
                        @translate(Invoice No.)</th>
                    <th>
                        @translate(Cust.)</th>   
                    <th>
                        @translate(Cust no.)</th>  
                    <th>
                        @translate(SLS Auth)</th>
                    <th>
                        @translate(Cust Type)</th>
                    <th>
                        @translate(Item Name)</th>
                    <th>
                        @translate(Item Code)</th>    
                    <th>
                        @translate(Quantity)</th>
                    <th>
                        @translate(Unit)</th>         
                    <th>
                        @translate(Unit Price)</th> 
                    <th>
                        @translate(Transaction Type)</th>
                    <th>
                        @translate(Amount)</th>
                    <th>
                        @translate(Iv Total)
                    </th>
                    <th>
                        @translate(Dis)
                    </th>                 
                    <th>
                        @translate(Receivable)
                    </th>
                    <th>
                        @translate(Received)
                    </th>
                    <th>
                        @translate(Balance)
                    </th>
                    <th>
                        @translate(Cash Auth)
                    </th>
                    <th>
                        @translate(Remarks)
                    </th>


                </tr>
            </thead>
             <tbody>
                <?php
                $total_price =0;
                $invoiceTotal = 0;
                ?>

                @foreach($data as $key =>$item)<?php $i=0;?>
                    @foreach ($item->saleProducts as $saleProduct)
                        <?php $match =$key+1;  ?>
                        @if(($match  % 2) == 0)
                        <tr style="background-color:#f0f0f0;">
                        @else
                        <tr style="background-color: white;">
                        @endif
                        
                            
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                INV000{{ $item->id  }}
                            </td>
                            <td >
                                {{$item->customer->name ?? 'N/A'}}
                            </td>
                            <td >
                                {{$item->customer->id ?? 'N/A'}}
                            </td>
                            <td>
                                {{$item->user->name}}
                            </td>
                            <td >
                                {{$item->customer->CustomerType->name ?? 'N/A'}}
                            </td>
                            <td>
                                {{ $saleProduct->product->name }}
                            </td>
                            <td>
                                {{ $saleProduct->product->code }}
                            </td>
                            <td>
                                {{ $saleProduct->quantity }}
                            </td>
                            <td>
                                {{ $saleProduct->product->unit->name }}
                            </td>
                            <td>
                                {{ formatePrice($saleProduct->unit_price) }}
                            </td>
                            <td>
                                Sale
                            </td>
                            <td>
                                {{ formatePrice($saleProduct->sub_price) }}
                                <input type="hidden" value="{{$total_price += $saleProduct->sub_price}}">

                            </td>
                            <td>
                                {{ formatePrice($item->total_price) }}
                                @if ($i==0)
                                <input type="hidden" value="{{$invoiceTotal += $item->total_price}}">
                                @endif
                            </td>
                            <td>
                                {{ $item->discount ?? 'N/A'}}
                            </td>
                            <td>
                                {{ $item->total_price }}
                            </td>
                            @if ($item->status == 'paid')
                                <td>
                                    {{ $item->total_price }}
                                </td>
                            @else   
                            <td>
                                {{ $item->status }}
                            </td>
                            @endif
                            @if ($item->status == 'paid')
                                <td>
                                    Null
                                </td>
                            @else   
                            <td>
                                {{ formatePrice($item->total_price) }}
                            </td>
                            @endif
                            
                            <td>
                                {{$item->user->name}}
                            </td>
                            <td>
                                {{ $item->follow_comment ?? 'N/A'}}
                            </td>

                        </tr>   <?php $i++;?> 
                    @endforeach
                @endforeach
            </tbody> 
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>            
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>
                        @translate(Total Price) : {{formatePrice($total_price)}}</strong></td>
                    <td><strong>
                        @translate(Total Price) : {{formatePrice($invoiceTotal)}}</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <!--end: Datatable -->
    </div>
</div>
<script>
    $(document).ready(function () {
$('#dtHorizontalExample').DataTable({
"scrollX": true
});
$('.dataTables_length').addClass('bs-select');
});
</script>
@endsection
