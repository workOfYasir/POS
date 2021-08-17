@extends('admin.master')

@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Sale  List)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <button type="button" class="btn btn-primary" id="invoice-button">@translate(Generate invoice)</button>
                    <div class="kt-portlet__head-actions">
                        <form method="get" action="" class="p-2">
                            <div class="input-group">
                                <input name="search"
                                       placeholder="@translate(Search by invoice)" class="form-control"
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
                    <th>@translate(Invoice Number)</th>
                    <th>@translate(Total Price)</th>
                    <th>@translate(Total Quantity)</th>
                    <th>@translate(Customer)</th>
                    <th>@translate(Created By)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                <form id="invoice" action="{{route('multiple.invoice')}}" method="post">
                    @csrf
                    @foreach($pos as $key => $item)
                        <tr>
                            <td>{{ ($key+1) + ($pos->currentPage() - 1)*$pos->perPage() }} </td>
                            <td>INV000{{$item->id}}</td>
                            <td>{{formatePrice($item->total_price)}}</td>
                            <td>{{$item->total_item}}</td>
                            <td>{{$item->customer->name ?? 'N/A'}}</td>
                            <td>{{$item->user->name}}</td>
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

                                                    <li class="kt-nav__item">
                                                        <a href="{{ route('stock.return.create', $item->id) }}"
                                                           class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon-reply"></i>
                                                            <span
                                                                class="kt-nav__link-text">@translate(Return Item)</span>
                                                        </a>
                                                    </li>

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
@endsection
