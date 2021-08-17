@extends('admin.master')

@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="card">
            <div class="card-header">
                <h2 class="text-primary">
                    @translate(Ledger)</h2>
                <div class="card-body">
                    <form method="{{route('pos.ledger')}}" method="get">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>
                                    @translate(Customer)</label>
                                <div class="input-daterange input-group">
                                <div class="col-lg-5 col-sm-12">
                                                <div class="form-group" style="margin-bottom:0px">
                                                    <select class="form-control select2 customer width-full" id="customer"
                                                            name="customer_id" style="opacity: 1;">
                                                            @foreach($customerData as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <!-- <div class="col-lg-6 col-sm-12">
                                      
                                            <div class="input-daterange input-group">
                                          
                                            <input type="text" class="form-control" id="kt_datepicker_2" name="start" value="{{Request::get('start')}}" placeholder="@translate(Start Date)" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                    </div>
                                     <input type="text" class="form-control" name="end" id="kt_datepicker_2" value="{{Request::get('end')}}" placeholder="@translate(End Date)" />

                                                </div>
                                            </div> -->
                                            <button type="submit" class="btn btn-outline-primary ml-2">
                                        @translate(Filter)</button>
                                </div>
                               
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>


        <div class="kt-portlet__body ">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable report table-responsive-sm" id="kt_table_1">
                 
                <thead>
                <tr>
                    <th>@translate(#)</th>
                    <th>@translate(Debit)</th>
                    <th>@translate(Credit)</th>
                    <th>@translate(Balance)</th>
                    <th>@translate(Created At)</th>
                  
       
                    

                    
                </tr>
                </thead>
                <tbody>
            
                    @csrf
                    <?php $balance=0;?>
                    @if($ledger ?? '')
                
                        @foreach($ledger ?? '' as $key => $item)
                            @if($item->credit)
                                <?php  $balance+=$item->credit;?>

                            @elseif($item->debit)
                                <?php $balance-=$item->debit; ?>
                            @endif
                            <tr>
                                
                                <td>INVOOO{{ $item->sale->id }}</td>
                                <td>{{ $item->debit }}</td>
                                <td>{{ $item->credit}}</td>
                                <td>{{$balance}}</td>
                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                            
                            </tr>  
                        @endforeach
                    @endif   
            
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td style="display:none"></td>
                    <td style="display:none"></td>
                    
                    <td ><strong>
                            @translate(Total Amount) : {{$balance}}</strong></td>
                    <td ></td>
                            
                </tr>
            </tfoot>

                  
               
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
