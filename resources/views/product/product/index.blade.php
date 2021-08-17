<?php $org = \App\Helper\Helper::organization()?>
@extends('admin.master')

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Product List)
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    @can('product-show')
                        <a href="javascript:void(0)" onclick="printBarcode()" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-print"></i>
                            @translate(Barcode Print)
                        </a>
                    @endcan
                </div>

                <form method="get" action="" class="p-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="@translate(Product Name)" value="{{Request::get('search')}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                @translate(Search)</button>
                        </div>
                    </div>
                </form>
                <div class="kt-portlet__head-actions">

                    @can('product-create')
                    <a href="{{ route("products.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        @translate(Add New Product)
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
                        @translate(Price)</th>
                    <th>
                        @translate(Category)</th>
                    @if(env('BARCODE') == "Show")
                    <th>
                        @translate(BarCode)</th>
                    @endif
                    <th>
                        @translate(Image)</th>
                    <th>
                        @translate(Action)</th>
                </tr>
            </thead>
            <tbody>
            <form action="{{route('product.barcode')}}" id="barcode-form" method="post">
                @csrf
                @foreach($products as $key => $item)
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" value="{{$item->id}}" class="form-check-input" id="exampleCheck1" name="product_id[]">
                            <label class="form-check-label m-2"
                                   for="exampleCheck1">{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</label>
                        </div></td>
                    <td>{{$item->name}}</td>
                    <td>
                        @translate(With Tax Price): {{formatePrice($item->price)}} <br />
                        @translate(Price): {{formatePrice($item->unit_price)}}<br />
                        @translate(Tax): {{$item->tax->name ?? "Inclusive"}}<br />
                    </td>
                    <td>
                        {{$item->category->name }}<br>
                        @translate(Brand): {{$item->brand->name }}<br>
                    </td>

                    @if(env('BARCODE') == "Show")
                        <td>
                            @if($item->code != null)
                                <img src="{{barcode_asset($item->code.'.jpeg')}}" width="80" height="50" class="img-thumbnail">
                            @endif
                        </td>
                        @endif
                    <td>
                        @if($item->image != null)
                            <img src="{{asset('uploads/product/'.$item->image)}}" width="80" height="80" class="img-thumbnail">
                            @endif
                    </td>
                    <td>
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    @can('product-show')
                                        @if(env('BARCODE') == "Show")
                                            <li class="kt-nav__item">
                                                <a href="{{ barcode_asset($item->code.'.jpeg') }}" target="_blank" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon-download"></i>
                                                    <span class="kt-nav__link-text">
                                                @translate(Download Barcode Image)</span>
                                                </a>
                                            </li>
                                            @endif
                                    <li class="kt-nav__item">
                                        <a href="{{ route('products.show', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-eye"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Show)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('product-update')
                                    <li class="kt-nav__item">
                                        <a href="{{ route('products.edit', $item->id) }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-edit"></i>
                                            <span class="kt-nav__link-text">
                                                @translate(Edit)</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('product-destroy')
                                    <li class="kt-nav__item">
                                        <a onclick="confirm_modal('{{ route('products.destroy', $item->id) }}')" class="kt-nav__link">
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
            </form>
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $products->links() }}
        </div>

        <!--end: Datatable -->
    </div>
</div>

@endsection
