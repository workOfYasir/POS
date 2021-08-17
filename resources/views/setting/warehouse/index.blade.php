@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(WareHouse List)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    @can('warehouse-create')
                    <button class="btn btn-brand btn-elevate btn-icon-sm" onclick="forModal('{{ route("warehouses.create") }}','@translate(Create WareHouse)')" type="button">
                        <i class="la la-plus"></i>
                        @translate(Add New WareHouse)
                    </button>
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
                    <th>
                        @translate(Id)</th>
                    <th>
                        @translate(Name)</th>
                    <th>
                        @translate(Address)</th>
                    <th>
                        @translate(Action)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($warehouses as $key=> $item)
                <tr>
                    <td>{{ $loop->index +1 }}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        {{$item->address ?? 'N/A'}}<br>
                        <strong>Phone :</strong>{{$item->phone ?? 'N/A'}}
                    </td>
                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('warehouse-update')
                                    <li class="kt-nav__item">
                                        <a onclick="forModal('{{ route('warehouses.edit', $item->id) }}', '@translate(WareHouse Edit)')" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-edit"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Edit)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('warehouse-destroy')
                                    <li class="kt-nav__item">
                                        <a onclick="confirm_modal('{{ route('warehouses.destroy', $item->id) }}')" class="kt-nav__link">
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

        </table>
        <!--end: Datatable -->
    </div>
</div>

@endsection
