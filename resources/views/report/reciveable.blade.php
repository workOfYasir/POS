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
                    @translate(Reciveable  Report)</h2>
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
                        @translate(SR)</th>
                    <th>
                        @translate(Invoice ID)</th>
                    <th>
                        @translate(Transaction Date)</th>
                    <th>
                        @translate(Aging)</th>    
                    <th>
                        @translate(Customer Name)</th> 
                    <th>
                        @translate(Customer Number)</th> 
                         
                    <th>
                        @translate(Reciveable Amount)</th>
                    <th>
                        @translate(Follow-Up Comment)</th>
                    <th>
                        @translate(Action)</th>
                       
                </tr>
            </thead>
            <tbody>
                <?php
                
                $totalReciveable =0;
                ?>

                @foreach($reciveable as $item)
                <?php 
                    $dateOfBirth = $item->created_at;
                    $days = \Carbon\Carbon::parse($dateOfBirth )->diff(\Carbon\Carbon::now())->format('%m months and %d days');
                ?>
                <tr>
                    <td>{{$loop -> index+1}}</td>
                    <td>INV000{{$item->id}}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $days }}</td>
                    <td class="text-primary">{{$item->customer->name ?? 'N/A'}}</td>
                    <td class="text-primary">{{$item->customer->number ?? 'N/A'}}</td>
                    <td class="text-primary">{{ $item->total_price ?? 'N/A'}}
                        <input type="hidden" value="{{$totalReciveable += $item->total_price}}"></td>
                    <td>{{ $item->follow_comment ?? 'N/A'}}</td>
                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('customer-update')
                                    <li class="kt-nav__item">
                                        <a onclick="forModal('{{ route('comment.edit', $item->id) }}', '@translate(Comment Update)')" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-edit"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Edit)</span>
                                        </a> 
                                    </li>
                                    @endcan
                                
                                </ul>
                            </div>
                        </div>    
                        {{-- <button type="submit" class="btn btn-info"  data-toggle="modal" 
                        
                        onclick="forModal('{{ route('comment.edit', $item->id) }}'" }}>Update</button> --}}
                </tr>
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
                    <td colspan="3"><strong>
                            @translate(Total Amount) : {{$totalReciveable}}</strong></td>
                            
                </tr>
            </tfoot>
        </table>
        {{-- @foreach ($reciveable as $item)
                <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id="userForm"> 
                               
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea class="form-control" name="followComment" rows="5"  id="comment">{{ $sale->follow_comment }}</textarea>
                                </div>
                               
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                           
                            </form>
                      </div>
                    </div>
                  </div> 
                </div>   
                @endforeach --}}
        <!--end: Datatable -->
        </div>   
    </div>
@endsection 
           
        