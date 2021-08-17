@extends('admin.master')

@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Purchase List)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    {{-- <button type="button" class="btn btn-primary" id="invoice-button">@translate(Generate invoice)</button> --}}
                    <div class="kt-portlet__head-actions">
                        <form method="get" action="" class="p-2">
                            <div class="input-group">
                                <input name="search" autocomplete="off" id="kt_datepicker_2"
                                       placeholder="@translate(Search by date)" class="form-control"
                                       value="{{Request::get('search')}}">
                                <button type="submit" class="btn btn-primary">@translate(Search)</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm"
                   id="kt_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@translate(Total Price)</th>
                    <th>@translate(Balance)</th>
                    <th>@translate(Total Quantity)</th>
                    <th>@translate(Discount)</th>
                    <th>@translate(Customer)</th>
                    <th>@translate(Status)</th>
                    <th>@translate(Payment Method)</th>
                    <th>@translate(Status Updated)</th>
                    <th>@translate(Paid At)</th>
                    <th>@translate(Created By)</th>
                    <th>@translate(Created At)</th>
                    <th>@translate(Action)</th>
                    

                    
                </tr>
                </thead>
                <tbody>
                <form id="invoice" action="{{route('multiple.invoice')}}" method="post">
                    @csrf
                    @foreach($pos as $key => $item)
                     <?php
                       $name=\App\User::all()->where('id',$item->status_updated_by);
                    //   $Name= user::where('id',$item->status_updated_by);
                       
                     ?>
                     
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" value="{{$item->id}}" class="form-check-input" id="exampleCheck1" name="invoice_id[]">
                                    <label class="form-check-label m-2"
                                           for="exampleCheck1">{{ ($key+1) + ($pos->currentPage() - 1)*$pos->perPage() }}</label>
                                </div>

                            </td>
                            <td>{{formatePrice($item->total_price)}}</td>
                            <td>
                                {{$item->balance}}
                            </td>
                            <td>
                                {{$item->total_item}}
                            </td>
                            <td>
                                {{formatePrice($item->discount)}}<br>
                            </td>
                            <td>{{$item->customer->name ?? 'N/A'}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->payment_method}}</td>
                            @if(empty($item->status_updated_by))

                                <td><p><a href="#" class="text-danger">Null</a></p></td> 
                                @else    
                            @foreach ($name as $items)
                            {{-- <td>{{$items->name ?? 'N/A'}}</td>  --}}
                            <td>{{$items->name}}</td>
                            
                            @endforeach
                            @endif
                            
                            @if(empty($item->paid_at))

                                <td><p><a href="#" class="text-danger">Null</a></p></td> 
                            @else
                                 <td>{{$item->paid_at}}</td>
                            @endif
                                
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->created_at}}</td>
                            
                           
                            <td>
                                <div class="dropdown dropdown-inline">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"
                                       aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            @can('pos')
                                                <li class="kt-nav__item">
                                                    <a href="{{ route('poses.show', $item->id) }}" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon-eye"></i>
                                                        <span class="kt-nav__link-text">@translate(Show)</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('pos')
                                                <li class="kt-nav__item">
                                                    <a href="{{ route('sales.invoices', $item->id) }}" target="_blank"
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon-paper-plane"></i>
                                                        <span
                                                            class="kt-nav__link-text">@translate(Create Invoice)</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('pos-delete')
                                                <li class="kt-nav__item">
                                                    <a onclick="confirm_modal('{{ route('poses.destroy', $item->id) }}')"
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon-delete"></i>
                                                        <span class="kt-nav__link-text">@translate(Delete)</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('pos')
                                            <li class="kt-nav__item">
                                                @if($item->status =='paid')   
                                                @else
                                                <li class="kt-nav__item">
                                                    <a onclick="forModal('{{ route('status.edit', $item->id) }}', '@translate(Comment Update)')" class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon-edit"></i>
                                                        <span class="kt-nav__link-text">
                                                            @translate(Status Update)</span>
                                                    </a> 
                                                </li>
                                                {{-- <a href="" class="kt-nav__link" 
                                                     data-toggle="modal" data-target="#exampleModal" data-id="{{ $item->id }}"
                                                    data-url="{{ url('status.update', $item->id) }}">>
                                                    <i class="kt-nav__link-icon flaticon-eye"></i>
                                                    <span class="kt-nav__link-text">@translate(Update Status)</span>
                                                </a>  --}}
                                                @endif
                                            </li>
                                            @endcan
                                            @can('pos')
                                                <li class="kt-nav__item">
                                                <a onclick="forModal('{{ route('pos.installment',$item->id) }}', '@translate(Installment)' )" 
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon-price-tag"></i>
                                                        <span class="kt-nav__link-text">@translate(Installment)</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>

                            </td>
                        </tr>  
                    @endforeach
                </form>
                </tbody>

                  
                <div class="float-left">
                    {{ $pos->links() }}
                </div>
            </table>
            <!--end: Datatable -->
        </div>
    </div>

@endsection

@section('script')
    <script>
     
        "use strict"
        $('#invoice-button').click(function (){
            $('#invoice').submit();
        });
    </script>
    
    <script type="text/javascript">
       
        // $('#exampleModal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget);
        //         var id = button.data('id');
        //         console.log(id);
        //         var url = $(this).attr('data-url');
        //         console.log(url)
        //     $('#userForm').attr("action", "{{ url('status/update') }}" + "/" + id);
        // });
        function status() {
    console.log('ok');
    
}
   </script>
    

@endsection
