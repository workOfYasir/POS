@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Supplier List)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <form method="get" action="" class="p-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="@translate(Supplier  Name)" value="{{Request::get('search')}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                @translate(Search)</button>
                        </div>
                    </div>
                </form>
                <div class="kt-portlet__head-actions">
                    @can('supplier-create')
                    <button class="btn btn-brand btn-elevate btn-icon-sm" onclick="forModal('{{ route("suppliers.create") }}','@translate(Create Supplier)')" type="button">
                        <i class="la la-plus"></i>
                        @translate(Add New Supplier)
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
                    <th>#</th>
                    <th>
                        @translate(Name)</th>
                    <th>
                        @translate(Address)</th>
                    <th>
                        @translate(Others)</th>
                    <th>
                        @translate(Image)</th>
                    <th>
                        @translate(Action)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $key=> $item)
                <tr>
                    <td>{{ ($key+1) + ($suppliers->currentPage() - 1)*$suppliers->perPage() }}</td>
                    <td>
                        @translate(Name) : {{$item->name}}<br>
                        @translate(Org) : {{$item->org}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                        @translate(Phone): {{$item->phone}}<br>
                        @translate(Email): {{$item->email}}</td>
                    <td>
                        @if($item->image)
                            <img src="{{asset('uploads/supplier/'.$item->image)}}" width="80" height="80" class="img-thumbnail">
                            @endif
                    </td>
                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('supplier-update')
                                    <li class="kt-nav__item">
                                        <a onclick="forModal('{{ route('suppliers.edit', $item->id) }}', '@translate(Suppliers Edit)')" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-edit"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Edit)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('supplier-destroy')
                                    <li class="kt-nav__item">
                                        <a onclick="confirm_modal('{{ route('suppliers.destroy', $item->id) }}')" class="kt-nav__link">
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
                {{ $suppliers->links() }}
            </div>
        </table>
        <!--end: Datatable -->
    </div>
</div>

@endsection
