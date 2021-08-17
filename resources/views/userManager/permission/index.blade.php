@extends('admin.master')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                User List
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    @can('permission-create')
                    <a href="{{ route("permissions.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Add New Permission
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">

        <!-- there are the main content-->
        <table class="table table-striped- table-bordered table-hover table-checkable report" id="kt_table_1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 1 ?>
                @foreach($permissions as $item)
                <tr>
                    <td>{{$a++}}</td>
                    <td>Name : {{$item->name}} <br> Slug : {{$item->slug}}</td>

                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('permission-update')
                                    <li class="kt-nav__item">
                                        {{-- <a href="{{ route('permissions.edit', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-edit"></i>
                                            <span class="kt-nav__link-text">Edit</span>
                                        </a> --}}
                                    </li>
                                    @endcan
                                    @can('permission-show')
                                    <li class="kt-nav__item">
                                        {{-- <a href="{{ route('permissions.show', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-eye"></i>
                                            <span class="kt-nav__link-text">Show</span>
                                        </a> --}}
                                    </li>
                                    @endcan
                                    @can('permission-destroy')
                                    <li class="kt-nav__item">
                                        {{-- <a onclick="confirm_modal('{{ route('permissions.destroy', $item->id) }}')" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-delete"></i>
                                            <span class="kt-nav__link-text">Delete</span>
                                        </a> --}}
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </tfoot>

        </table>
    </div>

</div>

@endsection
