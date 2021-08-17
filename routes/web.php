<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'installed'],function (){

    Route::redirect('/home','/');
    Route::get('/', 'HomeController@index')
          ->name('dashboard')->middleware('auth');
    Route::get('/invoice', 'HomeController@invoice');
    Route::get('/print/{id}', 'Pos\PosController@salePrint')
          ->name('sales.invoices')->middleware('auth');
    Route::get('/shortcut', 'Setting\OrganizationController@shortcut')
          ->name('shortcut');

    //Todo:There are the  custom login
    Auth::routes(['register' => false]);
    Route::post('login','Authentication\LoginController@login');
    Route::get('login','Authentication\LoginController@showLoginForm')
          ->name('login');
    Route::get('logout','Authentication\LoginController@logout')
          ->name('logout')->middleware('auth');
    Route::get('password_change/{id}','Authentication\LoginController@passwordChange')
          ->name('passwords.change')->middleware('auth');
    Route::post('password_update','Authentication\LoginController@passwordUpdate')
          ->name('passwords.update')->middleware('auth');

    //Todo:there are the user Manager section
    Route::get('user/destroy/{id}','UserManager\UserController@destroy')
        ->name('users.destroy')->middleware('permissions:user-destroy');
    Route::get('user/create','UserManager\UserController@create')
        ->name('users.create')->middleware('permissions:user-create');
    Route::post('user/store','UserManager\UserController@store')
        ->name('users.store')->middleware('permissions:user-create');
    Route::get('user/edit/{id}','UserManager\UserController@edit')
        ->name('users.edit')->middleware('permissions:user-update');
    Route::post('user/update','UserManager\UserController@update')
        ->name('users.update')->middleware('permissions:user-update');
    Route::get('user/show/{id}','UserManager\UserController@show')
        ->name('users.show')->middleware('permissions:user-show');
    Route::get('user/index','UserManager\UserController@index')
        ->name('users.index')->middleware('permissions:user-show');
        Route::get('permission/index','UserManager\PermissionController@index')->name('permissions.indexs');
        Route::get('permission/create','UserManager\PermissionController@create')->name('permissions.create');
    //group
    Route::get('group/destroy/{id}','UserManager\GroupController@destroy')
        ->name('groups.destroy')->middleware('permissions:group-destroy');
    Route::get('group/create','UserManager\GroupController@create')
        ->name('groups.create')->middleware('permissions:group-create');
    Route::post('group/store','UserManager\GroupController@store')
        ->name('groups.store')->middleware('permissions:group-create');
    Route::get('group/edit/{id}','UserManager\GroupController@edit')
        ->name('groups.edit')->middleware('permissions:group-update');
    Route::post('group/update','UserManager\GroupController@update')
        ->name('groups.update')->middleware('permissions:group-update');
    Route::get('group/show/{id}','UserManager\GroupController@show')
        ->name('groups.show')->middleware('permissions:group-show');
    Route::get('group/index','UserManager\GroupController@index')
        ->name('groups.index')->middleware('permissions:group-show');
        //end


    //category
    Route::get('category/create','Product\CategoryController@create')
        ->name('categories.create')->middleware('permissions:category-create');
    Route::post('category/store','Product\CategoryController@store')
        ->name('categories.store')->middleware('permissions:category-create');
    Route::get('category/edit/{id}','Product\CategoryController@edit')
        ->name('categories.edit')->middleware('permissions:category-update');
    Route::post('category/update','Product\CategoryController@update')
        ->name('categories.update')->middleware('permissions:category-update');
    Route::get('category/destroy/{id}','Product\CategoryController@destroy')
        ->name('categories.destroy')->middleware('permissions:category-destroy');
    Route::get('category/index','Product\CategoryController@index')
        ->name('categories.index')->middleware('permissions:category-show');

    //units
    Route::get('unit/create','Product\UnitController@create')
        ->name('units.create')->middleware('permissions:unit-create');
    Route::post('unit/store','Product\UnitController@store')
        ->name('units.store')->middleware('permissions:unit-create');
    Route::get('unit/edit/{id}','Product\UnitController@edit')
        ->name('units.edit')->middleware('permissions:unit-update');
    Route::post('unit/update','Product\UnitController@update')
        ->name('units.update')->middleware('permissions:unit-update');
    Route::get('unit/destroy/{id}','Product\UnitController@destroy')
        ->name('units.destroy')->middleware('permissions:unit-destroy');
    Route::get('unit/index','Product\UnitController@index')
        ->name('units.index')->middleware('permissions:unit-show');

    //brand
    Route::get('brand/create','Product\BrandController@create')
        ->name('brands.create')->middleware('permissions:brand-create');
    Route::post('brand/store','Product\BrandController@store')
        ->name('brands.store')->middleware('permissions:brand-create');
    Route::get('brand/edit/{id}','Product\BrandController@edit')
        ->name('brands.edit')->middleware('permissions:brand-update');
    Route::post('brand/update','Product\BrandController@update')
        ->name('brands.update')->middleware('permissions:brand-update');
    Route::get('brand/destroy/{id}','Product\BrandController@destroy')
        ->name('brands.destroy')->middleware('permissions:brand-destroy');
    Route::get('brand/index','Product\BrandController@index')
        ->name('brands.index')->middleware('permissions:brand-show');

    //product
    Route::get('product/create','Product\ProductController@create')
        ->name('products.create')->middleware('permissions:product-create');
    Route::post('product/store','Product\ProductController@store')
        ->name('products.store')->middleware('permissions:product-create');
    Route::get('product/edit/{id}','Product\ProductController@edit')
        ->name('products.edit')->middleware('permissions:product-update');
    Route::post('product/update','Product\ProductController@update')
        ->name('products.update')->middleware('permissions:product-update');
    Route::get('product/show/{id}','Product\ProductController@show')
        ->name('products.show')->middleware('permissions:product-show');
    Route::get('product/destroy/{id}','Product\ProductController@destroy')
        ->name('products.destroy')->middleware('permissions:product-destroy');
    Route::get('product/index','Product\ProductController@index')
        ->name('products.index')->middleware('permissions:product-show');
    Route::post('product/barcode','Product\ProductController@barcode_print')
        ->name('product.barcode')->middleware('permissions:product-show');


    //tax
    Route::get('tax/create','Setting\TaxController@create')
        ->name('taxes.create')->middleware('permissions:tax-create');
    Route::post('tax/store','Setting\TaxController@store')
        ->name('taxes.store')->middleware('permissions:tax-create');
    Route::get('tax/edit/{id}','Setting\TaxController@edit')
        ->name('taxes.edit')->middleware('permissions:tax-update');
    Route::post('tax/update','Setting\TaxController@update')
        ->name('taxes.update')->middleware('permissions:tax-update');
    Route::get('tax/destroy/{id}','Setting\TaxController@destroy')
        ->name('taxes.destroy')->middleware('permissions:tax-destroy');
    Route::get('tax/index','Setting\TaxController@index')
        ->name('taxes.index')->middleware('permissions:tax-show');

    //warehouse
    Route::get('warehouse/create','Setting\WareHouseController@create')
        ->name('warehouses.create')->middleware('permissions:warehouse-create');
    Route::post('warehouse/store','Setting\WareHouseController@store')
        ->name('warehouses.store')->middleware('permissions:warehouse-create');
    Route::get('warehouse/edit/{id}','Setting\WareHouseController@edit')
        ->name('warehouses.edit')->middleware('permissions:warehouse-update');
    Route::post('warehouse/update','Setting\WareHouseController@update')
        ->name('warehouses.update')->middleware('permissions:warehouse-update');
    Route::get('warehouse/destroy/{id}','Setting\WareHouseController@destroy')
        ->name('warehouses.destroy')->middleware('permissions:warehouse-destroy');
    Route::get('warehouse/index','Setting\WareHouseController@index')
        ->name('warehouses.index')->middleware('permissions:warehouse-show');

    //stock transfer
    Route::get('stock/create','Stock\StockController@create')
        ->name('stocks.create')->middleware('permissions:stock-create');
    Route::post('stock/store','Stock\StockController@store')
        ->name('stocks.store')->middleware('permissions:stock-create');
    Route::get('stock/edit/{id}','Stock\StockController@edit')
        ->name('stocks.edit')->middleware('permissions:stock-update');
    Route::post('stock/update','Stock\StockController@update')
        ->name('stocks.update')->middleware('permissions:stock-update');
    Route::get('stock/destroy/{id}','Stock\StockController@destroy')
        ->name('stocks.destroy')->middleware('permissions:stock-destroy');
    Route::get('stock/show/{id}','Stock\StockController@show')
        ->name('stocks.show')->middleware('permissions:stock-show');
    Route::get('stock/index','Stock\StockController@index')
        ->name('stocks.index')->middleware('permissions:stock-show');
    Route::get('stock/single/product/{id}','Stock\StockController@singleProduct')
        ->name('stocks.single.product');
    Route::get('stock/optionList/{id}','Stock\StockController@optionList')
        ->middleware('permissions:user-create');

    /*multiple.invoice*/
    Route::post('multiple/invoice','Pos\PosController@multipleInvoice')->name('multiple.invoice');

    Route::group(['middleware'=>'permissions:stock-return'],function (){
        /*stock adjustment*/
        Route::get('stock/adjustment','StockAdjustmentController@index')->name('stocks.adjustment.index');
        Route::get('stock/adjustment/create','StockAdjustmentController@create')->name('stocks.adjustment.create');
        Route::get('stock/adjustment/show/{id}','StockAdjustmentController@show')->name('stocks.adjustment.show');
        Route::post('stock/adjustment/store','StockAdjustmentController@store')->name('stocks.adjustment.store');
        Route::get('stock/adjustment/single/product/{id}','StockAdjustmentController@single_product');
        Route::get('stock/adjustment/destroy/{id}','StockAdjustmentController@destroy')->name('stocks.adjustment.destroy');
        Route::get('stock/adjustment/create','StockAdjustmentController@create')->name('stocks.adjustment.create');
        Route::get('stock/invoice/list','StockAdjustmentController@returnIndex')
            ->name('stocks.return.index');
        Route::get('stock/invoice/{id}','StockAdjustmentController@returnEdit')->name('stock.return.create');
        Route::get('return/confirm/{id}','StockAdjustmentController@returnConfirm')->name('return.sale.product');
        Route::get('return/index','StockAdjustmentController@returnProductIndex')->name('return.sale.index');
    });
    //supplier
    Route::get('supplier/create','Setting\SupplierController@create')
        ->name('suppliers.create')->middleware('permissions:supplier-create');
    Route::post('supplier/store','Setting\SupplierController@store')
        ->name('suppliers.store')->middleware('permissions:supplier-create');
    Route::get('supplier/edit/{id}','Setting\SupplierController@edit')
        ->name('suppliers.edit')->middleware('permissions:supplier-update');
    Route::post('supplier/update','Setting\SupplierController@update')
        ->name('suppliers.update')->middleware('permissions:supplier-update');
    Route::get('supplier/index','Setting\SupplierController@index')
        ->name('suppliers.index')->middleware('permissions:supplier-show');
    Route::get('supplier/destroy/{id}','Setting\SupplierController@destroy')
        ->name('suppliers.destroy')->middleware('permissions:supplier-destroy');

    //quotation transfer
    Route::get('quotation/create','Product\QuotationController@create')
          ->name('quotations.create')->middleware('permissions:quotation-create');
    Route::post('quotation/store','Product\QuotationController@store')
          ->name('quotations.store')->middleware('permissions:quotation-create');
    Route::get('quotation/print/{id}','Product\QuotationController@printQuotation')
          ->name('quotations.print')->middleware('permissions:quotation-show');
    Route::get('quotation/destroy/{id}','Product\QuotationController@destroy')
          ->name('quotations.destroy')->middleware('permissions:quotation-destroy');
    Route::get('quotation/show/{id}','Product\QuotationController@show')
          ->name('quotations.show')->middleware('permissions:quotation-show');
    Route::get('quotation/index','Product\QuotationController@index')
          ->name('quotations.index')->middleware('permissions:quotation-show');
    Route::get('quotation/single/product/{id}','Product\QuotationController@singleProduct');
    Route::get('quotation/sale/{id}','Product\QuotationController@addSaleShow')
    ->name('addSale.show')->middleware('permissions:quotation-show');
    Route::POST('quotation/saleStore/','Product\QuotationController@saleStore')
    ->name('sale.store')->middleware('permissions:quotation-show');
    //purchase
    Route::get('purchase/create','Purchase\PurchaseController@create')
          ->name('purchases.create')->middleware('permissions:purchase-create');
    Route::post('purchase/store','Purchase\PurchaseController@store')
          ->name('purchases.store')->middleware('permissions:purchase-create');
    Route::get('purchase/index','Purchase\PurchaseController@index')
          ->name('purchases.index')->middleware('permissions:purchase-show');
    Route::get('purchase/show/{id}','Purchase\PurchaseController@show')
          ->name('purchases.show')->middleware('permissions:purchase-show');
    Route::get('purchase/destroy/{id}','Purchase\PurchaseController@destroy')
          ->name('purchases.destroy')->middleware('permissions:purchase-destroy');
    Route::get('purchase/single/product/{id}','Purchase\PurchaseController@singleProduct')
          ->name('purchases.single.product');
    Route::get('purchase/payment/create/{id}','Purchase\PurchaseController@createPayment')
          ->name('purchases.payment.create');
    Route::post('purchase/payment/store','Purchase\PurchaseController@storePayment')
          ->name('purchases.payment.store');

    //customer
    Route::get('customer/create','Setting\CustomerController@create')
          ->name('customers.create')->middleware('permissions:customer-create');
    Route::post('customer/store','Setting\CustomerController@store')
          ->name('customers.store')->middleware('permissions:customer-create');
    Route::get('customer/edit/{id}','Setting\CustomerController@edit')
          ->name('customers.edit')->middleware('permissions:customer-update');
    Route::post('customer/update','Setting\CustomerController@update')
          ->name('customers.update')->middleware('permissions:customer-update');
    Route::get('customer/index','Setting\CustomerController@index')
          ->name('customers.index')->middleware('permissions:customer-show');
    Route::get('customer/destroy/{id}','Setting\CustomerController@destroy')
          ->name('customers.destroy')->middleware('permissions:customer-destroy');

    //todo::pos
    Route::get('pos/create','Pos\PosController@create')
          ->name('poses.create')->middleware('permissions:pos');
    Route::post('pos/store','Pos\PosController@store')
          ->name('poses.store')->middleware('permissions:pos');
    Route::get('pos/single/product/{id}','Pos\PosController@singleProduct')
          ->middleware('permissions:pos');

    Route::get('pos/single/product/barcode/{id}','Pos\PosController@singleProductBarcode')
        ->middleware('permissions:pos');

    Route::get('pos/product','Pos\PosController@posProduct')
          ->middleware('permissions:pos');
    Route::get('pos/installment/{id}','Pos\PosController@installment')
          ->middleware('permissions:pos')
          ->name('pos.installment');
    Route::post('pos/storeInstallment','Pos\PosController@storeInstallment')
          ->middleware('permissions:pos')
          ->name('pos.storeInstallment');
    Route::get('pos/ledger','Pos\PosController@showInstallment')
          ->name('pos.ledger');
    Route::get('sale/index','Pos\PosController@index')
          ->name('poses.index')->middleware('permissions:pos');
    Route::get('sale/show/{id}','Pos\PosController@show')
          ->name('poses.show')->middleware('permissions:pos');
    Route::get('sale/delete/{id}','Pos\PosController@destroy')
          ->name('poses.destroy')->middleware('permissions:pos');
    //Route To update the status
    Route::get('status/edit/{id}','Pos\PosController@statusEdit')
          ->name('status.edit')->middleware('permissions:pos');
    Route::Post('status/update','Pos\PosController@statusUpdate')
            ->name('status.update')->middleware('permissions:pos');
    Route::Post('comment/update','Pos\PosController@commentUpdate')
           ->name('comment.update')->middleware('permissions:pos');
    Route::get('comment/edit/{id}','Pos\PosController@edit')
          ->name('comment.edit')->middleware('permissions:pos');      

    //expense category expense.category.create
    Route::get('expense/category/create','Expense\CategoryController@create')
        ->name('expense.categories.create')->middleware('permissions:expense-categories-create');
    Route::get('expense/category/index','Expense\CategoryController@index')
        ->name('expense.categories.index')->middleware('permissions:expense-categories-show');
    Route::post('expense/category/store','expense\CategoryController@store')
        ->name('expense.categories.store')->middleware('permissions:expense-categories-create');
    Route::get('expense/category/edit/{id}','expense\CategoryController@edit')
        ->name('expense.categories.edit')->middleware('permissions:expense-categories-update');
    Route::post('expense/category/update','expense\CategoryController@update')
        ->name('expense.categories.update')->middleware('permissions:expense-categories-update');
    Route::get('expense/category/destroy/{id}','expense\CategoryController@destroy')
        ->name('expense.categories.destroy')->middleware('permissions:expense-categories-destroy');

    //expense
    Route::get('expenses/create','Expense\ExpenseController@create')
        ->name('expense.create')->middleware('permissions:expense-create');
    Route::get('expenses/index','Expense\ExpenseController@index')
        ->name('expense.index')->middleware('permissions:expense-show');
    Route::post('expenses/store','Expense\ExpenseController@store')
        ->name('expense.store')->middleware('permissions:expense-create');
    Route::get('expenses/edit/{id}','Expense\ExpenseController@edit')
        ->name('expense.edit')->middleware('permissions:expense-update');
    Route::post('expenses/update','Expense\ExpenseController@update')
        ->name('expense.update')->middleware('permissions:expense-update');
    Route::get('expenses/destroy/{id}','Expense\ExpenseController@destroy')
        ->name('expense.destroy')->middleware('permissions:expense-destroy');

    //report
    Route::get('report/pos','Report\ReportController@posReport')
        ->name('report.pos')->middleware('permissions:report'); //this is sales
    Route::get('report/purchase','Report\ReportController@purchaseReport')
        ->name('report.purchase')->middleware('permissions:report'); //this is sales
    Route::get('report/expense','Report\ReportController@expenseReport')
        ->name('report.expense')->middleware('permissions:report');
    Route::get('report/warehouse','Report\ReportController@warehouseReport')
        ->name('report.warehouse')->middleware('permissions:report');
    Route::get('report/stock','Report\ReportController@stockReport')
        ->name('report.stock')->middleware('permissions:report');
    Route::get('report/profit-loss','Report\ReportController@profitLossReport')
        ->name('report.profit.loss')->middleware('permissions:report');
    Route::get('report/tax','Report\ReportController@taxReport')
        ->name('report.tax')->middleware('permissions:report');   
    Route::get('report/reciveable','Report\ReportController@reciveableReport')
        ->name('report.reciveable')->middleware('permissions:report');    
    Route::get('report/report-book','Report\ReportController@reportBook')
        ->name('report.book')->middleware('permissions:report'); //this is sales  

    //org
    Route::get('org/edit','Setting\OrganizationController@edit')
        ->name('org.edit')->middleware('permissions:organization');
    Route::post('org/update','Setting\OrganizationController@update')
        ->name('org.update')->middleware('permissions:organization');

    //todo::middleware not add
    Route::get('smtp','Setting\OrganizationController@smtp')
        ->name('org.smtp')->middleware('permissions:mail');
    Route::post('/env_key_update', 'Setting\OrganizationController@env_key_update')
        ->name('env_key_update.update')->middleware('permissions:mail');
    Route::get('language/index','Setting\LanguageController@index')
        ->name('language.index')->middleware('permissions:language');
    Route::post('language/store','Setting\LanguageController@store')
        ->name('language.store')->middleware('permissions:language');
    Route::get('language/destroy/{id}','Setting\LanguageController@destroy')
        ->name('language.destroy')->middleware('permissions:language');
    Route::get('language/translate/{id}','Setting\LanguageController@translate_create')
        ->name('language.translate')->middleware('permissions:language');
    Route::post('language/translate/store','Setting\LanguageController@translate_store')
        ->name('language.translate.store')->middleware('permissions:language');
    Route::post('language/change','Setting\LanguageController@changeLanguage')
        ->name('language.change')->middleware('permissions:language');
    Route::get('language/default/{id}','Setting\LanguageController@defaultLanguage')
        ->name('language.default')->middleware('permissions:language');


    /*update route*/
    Route::get('pos/setting','Setting\OrganizationController@posSetting')->name('pos.setting');
});
