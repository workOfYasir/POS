@extends('admin.master')

@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Return Product  List)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm"
                   id="kt_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@translate(Invoice Number)</th>
                    <th>@translate(Product name)</th>
                    <th>@translate(Total Price)</th>
                    <th>@translate(Total Quantity)</th>
                    <th>@translate(Customer)</th>
                    <th>@translate(Created By)</th>
                </tr>
                </thead>
                <tbody>
                <form id="invoice" action="{{route('multiple.invoice')}}" method="post">
                    @csrf
                    @foreach($returns as $key => $item)
                        <tr>
                            <td>{{ ($key+1) + ($returns->currentPage() - 1)*$returns->perPage() }} </td>
                            <td>INV000{{$item->sale->id}}</td>
                            <td>{{$item->product->name}}</td>
                            <td>{{formatePrice($item->amount)}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->sale->customer->name ?? 'N/A'}}</td>
                            <td>{{$item->user->name}}</td>
                        </tr>
                    @endforeach
                </form>
                </tbody>
                <div class="float-left">
                    {{ $returns->links() }}
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
@endsection
