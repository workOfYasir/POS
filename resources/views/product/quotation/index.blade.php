<?php use App\Helper\Helper;

$org = Helper::organization() ?>
@extends('admin.master')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Quotation List)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <form method="get" action="" class="p-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="@translate(Name or Phone)" value="{{Request::get('search')}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                @translate(Search)</button>
                        </div>
                    </div>
                </form>
                <div class="kt-portlet__head-actions">
                    @can('quotation-create')
                    <a href="{{ route("quotations.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        @translate(Add New Quotation)
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
                    <th>
                        @translate(Name)</th>
                    <th>
                        @translate(Phone)</th>
                        <th>
                            @translate(Discount)</th>
                    <th>
                        @translate(Total Price)</th>
                    <th>
                        @translate(Create By)</th>
                    <th>
                        @translate(Created At)</th>
                    <th>
                        @translate(Action)</th>
                        <th>
                            @translate(Add Sale)</th>
                </tr>
            </thead>
            <tbody>

                @foreach($quotations as $key => $item)
                <tr>
                    <td>{{ ($key+1) + ($quotations->currentPage() - 1)*$quotations->perPage() }}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        {{$item->phone}}
                    </td>
                    <td>
                        {{formatePrice($item->discount)}}
                    </td>
                    <td>
                        {{formatePrice($item->total_price)}}
                    </td>
                    <td>
                        {{$item->user->name }} <br>
                    </td>
                    <td>
                        {{$item->created_at }} <br>
                    </td>
                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('quotation-show')
                                    <li class="kt-nav__item">
                                        <a href="{{ route('quotations.show', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-eye"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Show)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @canany('quotation-show','quotation')
                                    <li class="kt-nav__item">
                                        <a href="{{ route('quotations.print', $item->id) }}" target="_blank" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-print"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Print)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('quotation-destroy')
                                    <li class="kt-nav__item">
                                        <a href="{{ route('quotations.destroy', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-delete"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Delete)</span>
                                        </a>
                                    </li>
                                    @endcan

                                </ul>
                            </div>
                        </div>

                    </td>
                    <td>
                        <a href="{{ route('addSale.show', $item->id) }}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                            Add Sale
                          </button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <div class="float-left">
                {{ $quotations->links() }}
            </div>
        </table>

        <!--end: Datatable -->
    </div>
</div>

@endsection
