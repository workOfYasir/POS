@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm" id="kt_table_1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            @translate(Code)</th>
                        <th>
                            @translate(Name)</th>
                        <th>
                            @translate(Logo)</th>
                        <th>
                            @translate(Action)</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($languages as $item)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$item->code}}</td>
                        <td>
                            {{$item->name ?? 'N/A'}}
                        </td>
                        <td>
                            <span class="kt-nav__link-icon"><img src="{{asset('uploads/lang/'.$item->image)}}" height="30px" alt="{{$item->name}}" /></span>
                        </td>
                        <td>
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">

                                        <li class="kt-nav__item">
                                            <a href="{{route('language.translate',$item->id)}}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-laptop"></i>
                                                <span class="kt-nav__link-text">
                                                    @translate(Translate)</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="{{route('language.default',$item->id)}}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-car"></i>
                                                <span class="kt-nav__link-text">
                                                    @translate(Set As Default)</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a onclick="confirm_modal('{{ route('language.destroy', $item->id) }}')" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-delete"></i>
                                                <span class="kt-nav__link-text">
                                                    @translate(Delete)</span>
                                            </a>
                                        </li>
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
    <div class="col-lg-6 col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">
                    @translate(Language)</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('language.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="col-lg-3 col-sm-12">
                            <label class="control-label">
                                @translate(Name)</label>
                        </div>
                        <div class="col-lg-12  col-sm-12">
                            <input type="text" class="form-control" name="name" required placeholder="@translate(Ex: English)">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3  col-sm-12">
                            <label class="control-label">
                                @translate(Code)</label>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="code" required placeholder="@translate(Ex: en for english)">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-md-right">
                            @translate(Select Country)</label>
                        <div>
                            <select class="form-control select2 lang" name="image">
                                @foreach(readFlag() as $item)
                                @if ($loop->index >1)
                                <option value="{{$item}}" data-image="{{asset('uploads/lang/'.$item)}}"> {{flag($item)}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary btn-block" type="submit">
                                @translate(Save)</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
