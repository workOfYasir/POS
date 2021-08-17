<?php use App\Helper\Helper;

$org = Helper::organization() ?>
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
                    <div class="kt-portlet__head-actions">
                        @can('purchase-create')
                            <a href="{{ route("purchases.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                @translate(Add New Purchase)
                            </a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm" id="kt_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@translate(WareHouse)</th>
                    <th>@translate(Description)</th>
                    <th>@translate(Total Amount)</th>
                    <th>@translate(Paid)</th>
                    <th>@translate(Due)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>

                @foreach($purchases as $key => $item)
                    <tr>
                        <td>{{ ($key+1) + ($purchases->currentPage() - 1)*$purchases->perPage() }}</td>
                        <td>@translate(Warehouse) : {{$item->warehouse->name}}<br>
                            @translate(Supplier) : {{$item->supplier->name}}</td>
                        <td>
                            @php
                            echo $item->description
                            @endphp
                             <br>
                            @if($item->document != null)
                                <a href="{{asset('uploads/purchase/'.$item->document)}}" class="nav-link"
                                   target="_blank">Document</a>
                            @endif
                        </td>
                        <td>
                            @translate(Total Amount) : {{formatePrice($item->total_amount)}}<br>
                        </td>
                        <td> {{formatePrice($item->total_paid)}}</td>
                        <td class="text-danger">{{formatePrice(abs($item->total_due))}}</td>
                        <td>
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        @can('purchase-show')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('purchases.show', $item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-eye"></i>
                                                    <span class="kt-nav__link-text">@translate(Show)</span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('purchase')
                                            @if($item->total_due != 0)
                                                <li class="kt-nav__item">
                                                    <a onclick="forModal('{{ route('purchases.payment.create', $item->id) }}', '@translate(Purchase Payment Create)')"
                                                       class="kt-nav__link">
                                                        <i class="kt-nav__link-icon flaticon-paper-plane"></i>
                                                        <span
                                                            class="kt-nav__link-text">@translate(Create Payment)</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endcan
                                        @can('purchase-destroy')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('purchases.destroy', $item->id) }}"
                                                   class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-delete"></i>
                                                    <span class="kt-nav__link-text">@translate(Delete)</span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
                <div class="float-left">
                    {{ $purchases->links() }}
                </div>
            </table>

            <!--end: Datatable -->
        </div>
    </div>

@endsection
