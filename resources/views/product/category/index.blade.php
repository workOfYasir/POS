@extends('admin.master')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Category List)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <form method="get" action="" class="p-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   placeholder="@translate(Category Name)" value="{{Request::get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">@translate(Search)</button>
                            </div>
                        </div>
                    </form>
                    <div class="kt-portlet__head-actions">
                        @can('category-create')
                            <button class="btn btn-brand btn-elevate btn-icon-sm"
                                    onclick="forModal('{{ route("categories.create") }}','@translate(Create Category)')"
                                    type="button">
                                <i class="la la-plus"></i>
                                @translate(Add New Category)
                            </button>
                        @endcan

                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm" id="kt_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@translate(Category)</th>
                    <th>@translate(Parent Category)</th>
                    <th>@translate(Icon)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>

                @foreach($categories as $key => $item)
                    <tr>
                        <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            {{$item->parent->name ?? 'N/A'}}
                        </td>
                        <td>
                            @if($item->icon != null)
                                <img src="{{asset('uploads/category/'.$item->icon)}}" width="80" height="80"
                                     class="img-thumbnail">
                            @endif
                        </td>
                        <td>
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        @can('category-update')
                                            <li class="kt-nav__item">
                                                <a onclick="forModal('{{ route('categories.edit', $item->id) }}', '@translate(Category Edit)')"
                                                   class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-edit"></i>
                                                    <span class="kt-nav__link-text">@translate(Edit)</span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('category-destroy')
                                            <li class="kt-nav__item">
                                                <a onclick="confirm_modal('{{ route('categories.destroy', $item->id) }}')"
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
                    {{ $categories->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection
