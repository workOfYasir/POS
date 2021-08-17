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
                    @translate(Stock Adjustment List)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('stock-create')
                            <a href="{{ route("stocks.adjustment.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                @translate(Add New Stock Adjustment)
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
                    <th>@translate(WareHouse)</th>
                    <th>@translate(Amount)</th>
                    <th class="d-none">@translate(Description)</th>
                    <th>@translate(Product Count)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>

                @foreach($stocks as $key => $item)
                    <tr>
                        <td>{{ ($key+1) + ($stocks->currentPage() - 1)*$stocks->perPage() }}</td>
                        <td>{{$item->warehouse->name ?? 'N/A'}}</td>
                        <td>
                            {{formatePrice($item->amount)}}
                        </td>
                        <td class="d-none">
                            {{$item->description ?? null }} <br>
                        </td>
                        <td>
                            {{$item->adjustmentProduct->count()}}
                        </td>
                        <td>
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">

                                            <li class="kt-nav__item">
                                                <a href="{{ route('stocks.adjustment.show', $item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-eye"></i>
                                                    <span class="kt-nav__link-text">@translate(Show)</span>
                                                </a>
                                            </li>



                                            <li class="kt-nav__item">
                                                <a href="{{ route('stocks.adjustment.destroy', $item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-delete"></i>
                                                    <span class="kt-nav__link-text">@translate(Delete)</span>
                                                </a>
                                            </li>


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
