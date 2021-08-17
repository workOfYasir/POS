<?php use App\Helper\Helper;$org = Helper::organization();?>
@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Expense List)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    @can('expense-create')
                    <button class="btn btn-brand btn-elevate btn-icon-sm" onclick="forModal('{{ route("expense.create") }}','@translate(Create Expense)')" type="button">
                        <i class="la la-plus"></i>
                        @translate(Add New Expense)
                    </button>
                    @endcan

                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>
                        @translate(Category)</th>
                    <th>
                        @translate(WareHouse)</th>
                    <th>
                        @translate(Amount)</th>
                    <th>
                        @translate(Note)</th>
                    <th>
                        @translate(Action)</th>
                </tr>
            </thead>
            <tbody>

                @foreach($expenses as $key => $item)
                <tr>
                    <td>{{ ($key+1) + ($expenses->currentPage() - 1)*$expenses->perPage() }}</td>
                    <td>{{$item->category->name ?? 'N/A'}} <br>
                        {{$item->category->code ?? 'N/A'}}</td>
                    <td>
                        {{$item->warehouse->name ?? 'N/A'}}
                    </td>
                    <td>
                        {{$org->align == 0 ? $org->symbol.  $item->amount  : $item->amount   .$org->symbol  }}
                    </td>
                    <td>
                        {{$item->description ?? 'N/A'}}
                    </td>
                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('expense-update')
                                    <li class="kt-nav__item">
                                        <a onclick="forModal('{{ route('expense.edit', $item->id) }}', '@translate(Expense Edit)')" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-edit"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Edit)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('expense-destroy')
                                    <li class="kt-nav__item">
                                        <a onclick="confirm_modal('{{ route('expense.destroy', $item->id) }}')" class="kt-nav__link">
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
                </tr>
                @endforeach
            </tbody>
            <div class="float-left">
                {{ $expenses->links() }}
            </div>
        </table>
        <!--end: Datatable -->
    </div>
</div>

@endsection
