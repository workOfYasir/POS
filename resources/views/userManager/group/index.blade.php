@extends('admin.master')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Group List)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">

                        @can('group-create')
                        <a href="{{ route("groups.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            @translate(Add New Group)
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
                    <th>#</th>
                    <th width="10%"> @translate(Name)</th>
                    <th> @translate(Permission)</th>
                    <th> @translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                <?php $a = 1 ?>
                @foreach($groups as $item)
                    <tr>
                        <td>{{$a++}}</td>
                        <td>@translate(Name) : {{$item->name}} <br> Slug : {{$item->slug}}</td>
                        <td>
                            @foreach($item->permissions as $items)
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
                                        @can('group-update')
                                        <li class="kt-nav__item">
                                            <a href="{{ route('groups.edit', $item->id) }}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-edit"></i>
                                                <span class="kt-nav__link-text"> @translate(Edit)</span>
                                            </a>
                                        </li>
                                        @endcan
                                        @can('group-show')
                                        <li class="kt-nav__item">
                                            <a href="{{ route('groups.show', $item->id) }}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-eye"></i>
                                                <span class="kt-nav__link-text"> @translate(Show)</span>
                                            </a>
                                        </li>
                                            @endcan
                                            @can('group-destroy')
                                        <li class="kt-nav__item">
                                            <a  onclick="confirm_modal('{{ route('groups.destroy', $item->id) }}')" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-delete"></i>
                                                <span class="kt-nav__link-text"> @translate(Delete)</span>
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
        </div>
    </div>

@endsection
