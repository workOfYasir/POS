@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(User List)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    @can('user-create')
                    <a href="{{ route("users.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        @translate(Add New User)
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable report" id="kt_table_1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>
                        @translate(Name)</th>
                    <th>
                        @translate(Groups)</th>
                    <th>
                        @translate(Action)</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 1 ?>
                @foreach($users as $item)
                <tr>
                    <td>{{$a++}}</td>
                    <td>
                        @translate(Name) : {{$item->name}} <br>
                        @translate(Email) : {{$item->email}}</td>
                    <td>
                        @foreach($item->groups as $items)
                            <span class="badge badge-success m-2">{{$items->name}}</span>
                            @endforeach
                    </td>
                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('user-update')
                                    <li class="kt-nav__item">
                                        <a href="{{ route('users.edit', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-edit"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Edit)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('user-show')
                                    <li class="kt-nav__item">
                                        <a href="{{ route('users.show', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-eye"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Show)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @if($item->id == \Illuminate\Support\Facades\Auth::id())
                                        <li class="kt-nav__item">
                                            <a href="{{ route('passwords.change', $item->id) }}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-paper-plane"></i>
                                                <span class="kt-nav__link-text">
                                                    @translate(Change Password)</span>
                                            </a>
                                        </li>
                                        @endif
                                        @can('user-destroy')
                                        <li class="kt-nav__item">
                                            <a onclick="confirm_modal('{{ route('users.destroy', $item->id) }}')" class="kt-nav__link">
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
