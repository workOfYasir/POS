<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <title>@yield('title') @translate(Pos Screen)</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">
    <!--end::Fonts -->
    <link rel="icon" href="{{asset('uploads/org/'.\App\Helper\Helper::organization()->logo) ?? 'Pos'}}">


    <link href="{{asset('/backEnd')}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/backEnd')}}/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backEnd/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('backEnd/css/app.style.css') }}" rel="stylesheet">
    <!--end::Global Theme Styles -->
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body class="container-fluid">

{{-- <audio id="chatAudio" class="d-none" >
    <source src=
            "{{asset('beep.mp3')}}"
            type="audio/mpeg">
</audio> --}}
@if(env('POSTOP') == "Show")
    <div class="row">
        <span class="col-2 p-1"><kbd>Shift + W</kbd> @translate(Select Customer)</span>
        <span class="col-2 p-1"><kbd>Shift + A</kbd> @translate(Create new Customer)</span>
        <span class="col-2 p-1"><kbd>Shift + R</kbd> @translate(Product Select)</span>
        <span class="col-2 p-1"><kbd>Shift + C</kbd> @translate(Close Selected Dropdown)</span>
        <span class="col-2 p-1"><kbd>F2</kbd> @translate(Change Quantity )</span>
        <span class="col-2 p-1"><kbd>Tab</kbd> @translate(Next Product Quantity)</span>
        <span class="col-2 p-1"><kbd>Shift + Tab</kbd> @translate(Previous Product Quantity)</span>
        <span class="col-2 p-1"><kbd>Shift + Z</kbd> @translate(Category Wise Product)</span>
        <span class="col-2 p-1"><kbd>Shift + B</kbd> @translate(Brand Wise Product)</span>
            <span class="col-2 p-1"><kbd>Shift + D</kbd> @translate(Discount)</span>
        <span class="col-2 p-1"><kbd>Shift + S</kbd> @translate(Complete Order)</span>
            <span class="col-2 p-1"><kbd>Shift + Q</kbd> @translate(Quotation)</span>
    </div>
@endif
    @include('admin.include.error')
<div class="pt-3">
    <div class="row">
        <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('poses.store')}}" method="post"  id="posForm">
                        @csrf
                     <div class="card-header">
                        <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="row">
                                        @if($customer = Session::get('customer'))
                                            <div class="col-lg-10 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" readonly
                                                           value="{{$customer->name}} ({{$customer->number}})"
                                                           class="form-control" required>
                                                    <input type="hidden" name="customer_id" readonly
                                                           value="{{$customer->id}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-10 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control select2 customer width-full" id="customer"
                                                            name="customer_id">
                                                        <option value="0">@translate(Select Customer)</option>
                                                        @foreach($customers as $item)
                                                            <option value="{{$item->id}}">{{$item->name }}
                                                                ({{$item->number}})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        @can('customer-create')
                                        <div class="col-lg-2 col-sm-12">
                                            <button class="btn btn-primary customer"
                                                    onclick="forModal('{{ route("customers.create") }}','@translate(Create Customer)')"
                                                    type="button">
                                                <i class="la la-plus"></i>
                                            </button>
                                        </div>
                                            @endcan
                                    </div>
                                </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control select2 data width-full product" onchange="forSearchPur()" >
                                        <option>@translate(Select Product)</option>
                                        @foreach($products as $item)
                                            <option value="{{$item->id}}">{{$item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if(env('BARCODE') == "Show")
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>@translate(Search By Product Barcode)</label><br>
                                    <input type="text" onchange="forSearchBarcode()" class="form-control dataBarcode" autofocus>
{{--                                    <select class="form-control select2 dataBarcode width-full product focus" onchange="forSearchBarcode()" >--}}
{{--                                        <option>@translate(Search By Product Barcode)</option>--}}
{{--                                        @foreach($products as $item)--}}
{{--                                            <option value="{{$item->id}}">{{$item->code }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="scroll-product">
                            <div class="card">
                                <div class="ajax-table">
                                    <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm"
                                           id="kt_table_1">
                                        <thead>
                                        <tr>
                                            <th>@translate(Product Name)</th>
                                            <th>@translate(Quantity)</th>
                                            <th>@translate(Unit Price)</th>
                                            <th>@translate(Sub Price)</th>
                                            <th><i class="kt-nav__link-icon flaticon-delete"></i></th>
                                        </tr>
                                        </thead>
                                        <tbody id="productTable">

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card shadow-lg height-full">
                              <div class="m-3">
                                  <div class="row">
                                      <div class="col-lg-6 col-sm-12">
                                          <p class="font-size-20">@translate(Item) :<span id="total">0</span></p>
                                      </div>
                                      <div class="col-lg-6 col-sm-12">
                                          <p class="font-size-20">@translate(Total Price) : <span id="totalPrice">0.0</span></p>
                                      </div>
                                      <hr>
                                  </div>
                                  <div class="row">
                                      <div class="col-6">
                                          <input placeholder="@translate(Add Discount Amount)" min="0" class="form-control" type="number" id="discount" name="discount">
                                      </div>
                                      <div class="col-6">
                                       <button class="btn btn-block btn-primary save" type="button">@translate(Submit)</button>
                                      </div>
                                  </div>
                              </div>
                        </div>
                     </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control select2 category width-full" onchange="categoryByProduct()"
                                            id="category" >
                                        <option value="0">@translate(All Categories)</option>
                                        @foreach($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control select2 brand width-full"  onchange="categoryByProduct()" id="brand">
                                        <option value="0">@translate(All Brands)</option>
                                        @foreach($brands as $item)
                                            <option value="{{$item->id}}">{{$item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-show">
                        <div class="card-body">
                            <div class="row" id="products">
                                @foreach($products as $item)
                                    <div class="col-4 p-1 pointer" onclick="productAdd({{$item->id}})">
                                        <div class="card p-2">
                                            <img class="card-img-top img-fit" src="{{asset('uploads/product/'.$item->image)}}" height="150px;" width="100%">
                                            <hr>
                                            <div>
                                                <p class="text-truncate">{{$item->name}}({{$item->code}})</p>
                                                @translate(Price) : <span>{{$item->price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="{{asset('backEnd/js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('backEnd/js/popper.js')}}"></script>
    <script src="{{asset('backEnd/js/bootstrap.js')}}"></script>
    <script src="{{asset('backEnd/js/select2.js')}}"></script>
    @include('admin.include.delete')
    @include('admin.include.modal')
    <script src="{{asset('backEnd/js/jquery.keyboard-shortcuts.js')}}"></script>
    <script src="{{asset('backEnd/js/pos.js')}}"></script>
    <script src="{{asset('notify.js')}}"></script>

</body>

</html>
