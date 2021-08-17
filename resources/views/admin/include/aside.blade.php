<style>
   /* .kt-menu__item > .kt-menu__link .kt-menu__link-text {
    color:black !important;
}
.kt-menu__item > .kt-menu__link .kt-menu__link-text :hover {
    color:white !important;
}
li :hover{
    background-color:#5B451B !important;
    color: wheat !important;
}  */
/* .kt-aside-menu .kt-menu__nav > .kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover > .kt-menu__link {
    background-color:#5B451B !important;
    color: wheat !important;
} */
/* .kt-aside-menu .kt-menu__nav > .kt-menu__item.kt-menu__item--active > .kt-menu__link {
    background-color: #5B451B !important;
} */
</style>


<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
     id="kt_aside">
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand" kt-hidden-height="65"  style="background-color: white;">
        <div class="kt-aside__brand-logo">
            <a href="{{url('/')}}">
                <img  alt="Logo" src="{{asset('uploads/org/'.\App\Helper\Helper::organization()->logo) ?? 'Pos'}}" width="80"
                     height="auto">
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "></path>
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "></path>
                        </g>
                    </svg>
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                        </g>
                    </svg>
                </span>
            </button>

        </div>
    </div>
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid"
         id="kt_aside_menu_wrapper" >
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1"
             data-ktmenu-scroll="1" >

            <ul class="kt-menu__nav">
                <li class="kt-menu__item {{request()->is('/') ? 'kt-menu__item--active':null}}" aria-haspopup="true" >
                    <a
                        href="{{url('/')}}" class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon2-dashboard"></i><span
                            class="kt-menu__link-text">@translate(Dashboard)</span></a></li>

                @anypermission('user-create','user-update',
                'user-show','user-destroy','permission-destroy',
                'permission-create','permission-update','permission-show','group-destroy','group-create','group-update','group-show')
                <li class="kt-menu__item  kt-menu__item--submenu {{request()->is('user*')
                                                                 || request()->is('permission*')
                                                                 || request()->is('group*')
                                                                  ? 'kt-menu__item--open kt-menu__item--here' : null}}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-users-1"><span></span></i><span
                            class="kt-menu__link-text">@translate(User Management)</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @anypermission('user-destroy','user-create','user-update','user-show')
                            <li class="kt-menu__item  {{request()->is('user*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{url('user/index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(User)</span></a></li>
                            @endanypermission
                            @anypermission('group-destroy','group-create','group-update','group-show')
                            <li class="kt-menu__item {{request()->is('group*') ? 'kt-menu__item--active' : null}}"
                                aria-haspopup="true"><a
                                    href="{{url('group/index')}}"
                                    class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Group)</span></a></li>
                            @endanypermission

                        </ul>
                    </div>
                </li>
                @endanypermission
                @anypermission('category-create','category-update','category-destroy','category-show',
                'unit-show','unit-destroy','unit-update','unit-create','brand-show','brand-update',
                'brand-destroy','brand-create','product-create','product-update','product-show','product-destroy')
                <li class="kt-menu__item  kt-menu__item--submenu {{request()->is('category*')
                                                                  || request()->is('unit*')
                                                                  || request()->is('brand*')
                                                                  || request()->is('product*')
                                                                  || request()->is('tax*')
                                                                  ? 'kt-menu__item--open kt-menu__item--here'
                                                                  : null}}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon2-shopping-cart"><span></span></i><span
                            class="kt-menu__link-text">@translate(Product)</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @anypermission('category-create','category-update','category-destroy','category-show')
                            <li class="kt-menu__item  {{request()->is('category*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('categories.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Category)</span></a></li>
                            @endanypermission
                            @anypermission('unit-create','unit-update','unit-destroy','unit-show')
                            <li class="kt-menu__item  {{request()->is('unit*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('units.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Unit)</span></a></li>
                            @endanypermission
                            @anypermission('brand-create','brand-update','brand-destroy','brand-show')
                            <li class="kt-menu__item  {{request()->is('brand*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('brands.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Brand)</span></a></li>
                            @endanypermission

                            @anypermission('tax-create','tax-update','tax-destroy','tax-show')
                            <li class="kt-menu__item  {{request()->is('tax*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('taxes.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Tax)</span></a></li>
                            @endanypermission
                            @anypermission('product-create')
                            <li class="kt-menu__item  {{request()->is('product/create') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('products.create')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Add Product)</span></a></li>
                            @endanypermission
                            @anypermission('product-update','product-show','product-destroy')
                            <li class="kt-menu__item  {{request()->is('product/index')
                                                      || request()->is('product/edit*')
                                                      || request()->is('product/show*')
                                                      ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('products.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Product List)</span></a></li>
                            @endanypermission
                        </ul>
                    </div>
                </li>
                @endanypermission
                @anypermission('quotation-create','quotation-show','quotation-destroy','quotation')
                <li class="kt-menu__item  {{request()->is('quotation*') ? 'kt-menu__item--active' :null}}"
                    aria-haspopup="true"><a href="{{route('quotations.index')}}"
                                            class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon-notes"><span></span></i><span
                            class="kt-menu__link-text">@translate(Quotation)</span></a></li>
                @endanypermission
                @anypermission('customer-create','customer-update','customer-show','customer-destroy')
                <li class="kt-menu__item  {{request()->is('customer*') ? 'kt-menu__item--active' :null}}"
                    aria-haspopup="true"><a href="{{route('customers.index')}}"
                                            class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon-customer"><span></span></i><span
                            class="kt-menu__link-text">@translate(Customer)</span></a></li>
                @endanypermission
                @anypermission('pos')
                <li class="kt-menu__item  {{request()->is('pos*') ? 'kt-menu__item--active' :null}}"
                    aria-haspopup="true"><a target="_blank" href="{{route('poses.create')}}"
                                            class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon2-menu-2"><span></span></i><span
                            class="kt-menu__link-text">@translate(POS)</span></a></li>
                @endanypermission
                @anypermission('pos')
                <li class="kt-menu__item  {{request()->is('pos*') ? 'kt-menu__item--active' :null}}"
                    aria-haspopup="true"><a target="_blank" href="{{route('pos.ledger')}}"
                                            class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon2-chart"><span></span></i><span
                            class="kt-menu__link-text">@translate(Ledger)</span></a></li>
                @endanypermission
                @anypermission('pos')
                <li class="kt-menu__item  {{request()->is('sale*') ? 'kt-menu__item--active' :null}}"
                    aria-haspopup="true"><a href="{{route('poses.index')}}"
                                            class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon-open-box"><span></span></i><span
                            class="kt-menu__link-text">@translate(Sales List (POS))</span></a></li>
                @endanypermission
                @anypermission('purchase','purchase-destroy','purchase-show','purchase-create')
                <li class="kt-menu__item  kt-menu__item--submenu {{request()->is('purchase*')   ? 'kt-menu__item--open kt-menu__item--here' : null}}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-cart"><span></span></i><span
                            class="kt-menu__link-text">@translate(Purchase)</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            @anypermission('purchase-show','purchase-destroy')
                            <li class="kt-menu__item  {{request()->is('purchase/index')
                                                      ||request()->is('purchase/show*')
                                                      ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('purchases.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Purchase List)</span></a></li>
                            @endanypermission
                            @can('purchase-create')
                                <li class="kt-menu__item  {{request()->is('purchase/create') ? 'kt-menu__item--active' :null}}"
                                    aria-haspopup="true"><a href="{{route('purchases.create')}}"
                                                            class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">@translate(Create Purchase)</span></a></li>
                            @endcan


                        </ul>
                    </div>
                </li>
                @endanypermission
                @anypermission('expense-create','expense-show','expense-update','expense-destroy','expense-categories-create','expense-categories-update','expense-categories-destroy','expense-categories-show')
                <li class="kt-menu__item  kt-menu__item--submenu {{request()->is('expenses*') ||request()->is('expense/category*')  ? 'kt-menu__item--open kt-menu__item--here' : null}}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-price-tag"><span></span></i><span
                            class="kt-menu__link-text">@translate(Expenses)</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @anypermission('expense-categories-create','expense-categories-show','expense-categories-update','expense-categories-destroy')
                            <li class="kt-menu__item  {{request()->is('expense/category*')  ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('expense.categories.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Expense Category)</span></a></li>
                            @endanypermission
                            @anypermission('expense-create','expense-show','expense-update','expense-destroy')
                            <li class="kt-menu__item  {{request()->is('expenses*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('expense.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Expense) </span></a></li>
                            @endanypermission
                        </ul>
                    </div>
                </li>
                @endanypermission

                @anypermission('stock','stock-create','stock-update','stock-destroy','stock-show')
                <li class="kt-menu__item  kt-menu__item--submenu {{request()->is('stock/index*')
|| request()->is('stock/edit*')
|| request()->is('stock/show*')   ? 'kt-menu__item--open kt-menu__item--here' : null}}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon2-line-chart"><span></span></i><span
                            class="kt-menu__link-text">@translate(Stock Transfer)</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @anypermission('stock-update','stock-destroy','stock-show')
                            <li class="kt-menu__item  {{request()->is('stock/index')
                                                      || request()->is('stock/edit*')
                                                      ||request()->is('stock/show*')
                                                      ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('stocks.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Stock List)</span></a></li>
                            @endanypermission
                            @anypermission('stock-create','stock')
                            <li class="kt-menu__item  {{request()->is('stock/create') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('stocks.create')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Add Stock Transfer)</span></a></li>
                            @endanypermission

                        </ul>
                    </div>
                </li>
                @endanypermission

                {{--stock adjustment--}}
                @can('stock-return')
                    <li class="kt-menu__item  kt-menu__item--submenu {{request()->is('stock/invoice/list') ||
request()->is('return*') ||
request()->is('stock/invoice*') ||
request()->is('stock/adjustment*')   ? 'kt-menu__item--open kt-menu__item--here' : null}}"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                            href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                                class="kt-menu__link-icon flaticon2-add-1"><span></span></i><span
                                class="kt-menu__link-text">@translate(Stock Adjustment)</span><i
                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu"><span
                                class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">

                                <li class="kt-menu__item  {{request()->is('stock/adjustment/show')
                                                      || request()->is('stock/adjustment')
                                                      ? 'kt-menu__item--active' :null}}"
                                    aria-haspopup="true"><a href="{{route('stocks.adjustment.index')}}"
                                                            class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">@translate(Stock Adjustment )</span></a></li>


                                <li class="kt-menu__item  {{request()->is('stock/adjustment/create') ? 'kt-menu__item--active' :null}}"
                                    aria-haspopup="true"><a href="{{route('stocks.adjustment.create')}}"
                                                            class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">@translate(Add Stock Adjustment)</span></a></li>

                                <li class="kt-menu__item  {{request()->is('stock/invoice/list') || request()->is('stock/invoice*')
                                                      ? 'kt-menu__item--active' :null}}"
                                    aria-haspopup="true"><a href="{{route('stocks.return.index')}}"
                                                            class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">@translate(Return Product)</span></a></li>

                                <li class="kt-menu__item  {{request()->is('return*')
                                                      ? 'kt-menu__item--active' :null}}"
                                    aria-haspopup="true"><a href="{{route('return.sale.index')}}"
                                                            class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">@translate(Return Product List)</span></a></li>


                            </ul>
                        </div>
                    </li>
                    {{--stock adjustment--}}
                @endcanany

                @anypermission('report')
                <li class="kt-menu__item  kt-menu__item--submenu {{request()->is('report*')   ? 'kt-menu__item--open kt-menu__item--here' : null}}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-download-1"><span></span></i><span
                            class="kt-menu__link-text">@translate(Report)</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  {{request()->is('report/recivebale*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('report.reciveable')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Reciveable Report) </span></a></li> 
                            
                                        
                            <li class="kt-menu__item  {{request()->is('report/book*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('report.book')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Book Report) </span></a></li>             

                            <li class="kt-menu__item  {{request()->is('report/pos*')  ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('report.pos')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Sale Report) </span></a></li> 
                                        
                            <li class="kt-menu__item  {{request()->is('report/stock*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('report.stock')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Stock Report) </span></a></li>
                                                    
                                                    
                            <li class="kt-menu__item  {{request()->is('report/profit-loss*')  ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('report.profit.loss')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Profit/Loss Report)</span></a></li>


                            <li class="kt-menu__item  {{request()->is('report/expense*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('report.expense')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Expense Report) </span></a></li>


                            <li class="kt-menu__item  {{request()->is('report/tax*')  ? 'kt-menu__item--active' :null}}"
                                      aria-haspopup="true"><a href="{{route('report.tax')}}"
                                            class="kt-menu__link "><i
                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                            class="kt-menu__link-text">@translate(Tax Report)</span></a></li>            

                            <li class="kt-menu__item  {{request()->is('report/tax*')  ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="#"
                                      class="kt-menu__link "><i
                      class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                      class="kt-menu__link-text">@translate(Payable Report)</span></a></li> 

                      <li class="kt-menu__item  {{request()->is('report/purchase*') ? 'kt-menu__item--active' :null}}"
                        aria-haspopup="true"><a href="{{route('report.purchase')}}"
                                                class="kt-menu__link "><i
                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                class="kt-menu__link-text">@translate(Purchase Report) </span></a></li>

                            <li class="kt-menu__item  {{request()->is('report/warehouse*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('report.warehouse')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Warehouse Report) </span></a></li>

                            <li class="kt-menu__item  {{request()->is('report/purchase*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="#"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Item Wise Sales Report) </span></a></li>
                            
                                       


                        </ul>
                    </div>
                </li>
                @endanypermission

                @anypermission('tax-show','tax-destroy','tax-update','tax-create','warehouse-show','warehouse-destroy','warehouse-update','warehouse-create','organization')
                <li class="kt-menu__item  kt-menu__item--submenu {{
                                                                  request()->is('org*')
                                                                 || request()->is('warehouse*')
                                                                 || request()->is('supplier*')
                                                                 || request()->is('smtp*')
                                                                 || request()->is('language*')
                                                                 ? 'kt-menu__item--open kt-menu__item--here' : null}}"
                    aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a
                        href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon2-settings"><span></span></i><span
                            class="kt-menu__link-text">@translate(Setting)</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            @anypermission('warehouse-create','warehouse-update','warehouse-destroy','warehouse-show')
                            <li class="kt-menu__item  {{request()->is('warehouse*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('warehouses.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(WareHouse)</span></a></li>
                            @endanypermission
                            @anypermission('supplier-create','supplier-update','supplier-show','supplier-destroy')
                            <li class="kt-menu__item  {{request()->is('supplier*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('suppliers.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Supplier)</span></a></li>
                            @endanypermission
                            @can('organization')
                                <li class="kt-menu__item  {{request()->is('org*') ? 'kt-menu__item--active' :null}}"
                                    aria-haspopup="true"><a href="{{route('org.edit')}}"
                                                            class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">@translate(Organization)</span></a></li>
                            @endcan
                             @can('mail')
                            <li class="kt-menu__item  {{request()->is('smtp*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('org.smtp')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(SMTP Settings)</span></a></li>

                                <li class="kt-menu__item  {{request()->is('pos/setting*') ? 'kt-menu__item--active' :null}}"
                                    aria-haspopup="true"><a href="{{route('pos.setting')}}"
                                                            class="kt-menu__link "><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                            class="kt-menu__link-text">@translate(POS Settings)</span></a></li>
@endcan
                            @can('language')
                            <li class="kt-menu__item  {{request()->is('language*') ? 'kt-menu__item--active' :null}}"
                                aria-haspopup="true"><a href="{{route('language.index')}}"
                                                        class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">@translate(Language Settings)</span></a></li>
@endcan
                        </ul>
                    </div>
                </li>
                @endanypermission

            </ul>
        </div>
    </div>
</div>
