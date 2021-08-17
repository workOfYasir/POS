<?php

use App\Helper\Helper;

$org = Helper::organization();
?>
@extends('admin.master')

@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Stock Transfer List)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('stock-create')
                            <a href="{{ route("stocks.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                @translate(Add New Stock Transfer)
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
                    <th>@translate(Id)</th>
                    <th>@translate(WareHouse To)</th>
                    <th>@translate(WareHouse From)</th>
                    <th>@translate(Shipping Cost)</th>
                    <th>@translate(Description)</th>
                    <th>@translate(TotalAmount)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>

                @foreach($stocks as $key => $item)
                    <tr>
                        <td>{{ ($key+1) + ($stocks->currentPage() - 1)*$stocks->perPage() }}</td>
                        <td>{{$item->toWarehouse->name}}</td>
                        <td>
                            {{$item->fromWarehouse->name}}
                        </td>
                        <td>
                            {{formatePrice($item->shipping_cost)}}
                        </td>
                        <td>
                            {{$item->description ?? null }} <br>
                            @if($item->document != null)
                                <a href="{{asset('uploads/stock/'.$item->document)}}" class="nav-link" target="_blank">@translate(Document)</a>
                            @endif
                        </td>
                        <td>
                            {{formatePrice($item->total_amount)}}
                        </td>
                        <td>
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        @can('stock-show')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('stocks.show', $item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-eye"></i>
                                                    <span class="kt-nav__link-text">@translate(Show)</span>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('stock-destroy')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('stocks.destroy', $item->id) }}" class="kt-nav__link">
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
                    {{ $stocks->links() }}
                </div>
            </table>

            <!--end: Datatable -->
        </div>
    </div>

@endsection
