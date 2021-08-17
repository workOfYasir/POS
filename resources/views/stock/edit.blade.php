@extends('admin.master')
@section('content')
    <!-- Content Header (Page header) -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @translate(Stock Transfer Create)
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <!--We Can Add There button -->
                    <a href="{{ route("stocks.index") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-list"></i>
                        @translate(Show All Stock Transfer)
                    </a>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <form action="{{route('stocks.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="hidden" name="id" value="{{$stock->id}}">
                    <div class="row">

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(To WareHouse)</label>
                                <div>
                                    <select class="form-control kt-select2 width-full" id="kt_select2_3"
                                            name="to_warehouse" required>
                                        <option value="">@translate(Select WareHouse)</option>
                                        @foreach($warehouses as $item)
                                            <option
                                                value="{{$item->id}}" {{$stock->toWarehouse->id == $item->id ? 'selected' :null}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(From WareHouse)</label>
                                <div>
                                    <select class="form-control kt-select2 width-full" id="kt_select2_3"
                                            name="from_warehouse" required>
                                        <option value="">@translate(Select WareHouse)</option>
                                        @foreach($warehouses as $item)
                                            <option
                                                value="{{$item->id}}" {{$stock->fromWarehouse->id == $item->id ? 'selected' :null}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Shipping Cost)</label>
                                <div>
                                    <input class="form-control" value="{{$stock->shipping_cost}}" name="shipping_cost"
                                           type="number" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Document)</label>
                                <div>
                                    <input class="form-control-file" name="newDocument" type="file">
                                </div>
                            </div>
                            <hr>
                            @if($stock->document != null)
                                <input type="hidden" name="document" value="{{$stock->document}}">
                                <a href="{{asset('uploads/stock/'.$stock->document)}}" class="nav-link" target="_blank">@translate(Document)</a>
                            @endif
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label text-md-right">@translate(Description)</label>
                                <div>
                                    <textarea class="summernote" id="kt_summernote_1" name="description"
                                              placeholder="Place some text here">
                                        @php
                                          echo $stock->description
                                        @endphp
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <!--Col end-->
                    </div>
                    <hr>

                </div>
                <div class="float-right">
                    <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
                </div>
            </form>
        </div>
    </div>

@endsection
