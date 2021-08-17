<?php $org = \App\Helper\Helper::organization()?>
@extends('admin.master')
@section('title')
    pos reports
@endsection
@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="card">
            <div class="card-header">
                <h2 class="text-primary">
                    @translate(TAX  Report)</h2>
                <div class="card-body">
                    <form method="{{route('report.profit.loss')}}" method="get">
                        <div class="row">
                            <div class="form-group col-8">
                                <label>
                                    @translate(Date)</label>
                                <div class="input-daterange input-group">
                                    <input type="text" class="form-control" id="kt_datepicker_2" name="start" value="{{Request::get('start')}}" placeholder="@translate(Start Date)" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                    </div>
                                     <input type="text" class="form-control" name="end" id="kt_datepicker_2" value="{{Request::get('end')}}" placeholder="@translate(End Date)" />
                                    {{-- <div class="col-ls-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label text-md-right">
                                                @translate(Product)</label>
                                                <div>
                                                    <select class="form-control kt-select2 width-full select" name="product_id">
                                                        <option value="">
                                                            @translate(Select Product)</option>
                                                        @foreach($products as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                    </div> --}}
                                    <button type="submit" class="btn btn-outline-primary ml-2">
                                        @translate(Filter)</button>
                                </div>

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable report table-responsive-sm" id="kt_table_1">
            <thead>
                <tr>
                    <th>
                        @translate(Serial)</th>
                    <th>
                        @translate(Date)</th>
                    <th>
                        @translate(TAX)</th>
                       
                </tr>
            </thead>
            <tbody>
                <?php
                
                $total_tax =0;
                ?>

                @foreach($results as $item)
                <tr>
                    <td>{{$loop -> index+1}}</td>
                    <td>{{ $item->created }}</td>
                    <td class="text-primary">{{ $item->daily_total ?? 'N/A'}}
                        <input type="hidden" value="{{$total_tax += $item->daily_total}}"></td>
                    
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    
                    
                    
                    <td><strong>
                            @translate(Total TAX) : {{$total_tax}}</strong></td>
                            
                </tr>
            </tfoot>
        </table>

        <!--end: Datatable -->
        </div>   
    </div>
@endsection             
        