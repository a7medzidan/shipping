<?php


use App\Http\Controllers\Admin\{AuthController, HomeController,};
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AuthController::class, 'loginView'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'postLogin'])->name('admin.postLogin');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {


    Route::get('/', [HomeController::class,'index'])->name('admin.index');
    Route::get('calender', [HomeController::class,'calender'])->name('admin.calender');


    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');


    ### admins

    Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);
    Route::get('activateAdmin',[App\Http\Controllers\Admin\AdminController::class,'activate'])->name('admin.active.admin');


    ### roles
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);//setting


    ### categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);//setting



    ### countries
    Route::resource('countries', \App\Http\Controllers\Admin\CountryController::class);//setting

    Route::resource('repository', \App\Http\Controllers\Admin\RepositoryController::class);//repository
    ### categories
    Route::resource('provinces', \App\Http\Controllers\Admin\ProvinceController::class);//setting
    Route::get('getGovernorates', [\App\Http\Controllers\Admin\ProvinceController::class,'getGovernorates'])->name('admin.getGovernorates');//setting


    ### delivers
    Route::resource('delivers', \App\Http\Controllers\Admin\DeliveryController::class);//setting
    Route::get('getDeliveries', [\App\Http\Controllers\Admin\DeliveryController::class,'getDeliveries'])->name('admin.getDeliveries');//setting


    ### traders
    Route::resource('traders', \App\Http\Controllers\Admin\TraderController::class);//setting
    Route::get('addOrderToTrader/{id}',[\App\Http\Controllers\Admin\TraderController::class,'addOrderToTrader'])->name('admin.addOrderToTrader');
    Route::post('storeOrderToTrader/{id}',[\App\Http\Controllers\Admin\TraderController::class,'storeOrderToTrader'])->name('admin.storeOrderToTrader');
    Route::get('getTraders', [\App\Http\Controllers\Admin\TraderController::class,'getTraders'])->name('admin.getTraders');//setting


    Route::resource('orders', \App\Http\Controllers\Admin\Order\NewOrderController::class);//setting
    Route::get('getOrderDetails',[\App\Http\Controllers\Admin\Order\NewOrderController::class,'getOrderDetails'])->name('admin.getOrderDetails');
    Route::get('changeDelivery',[\App\Http\Controllers\Admin\Order\NewOrderController::class,'changeDelivery'])->name('admin.changeDelivery');
    Route::get('changeStatus',[\App\Http\Controllers\Admin\Order\NewOrderController::class,'changeStatus'])->name('admin.changeStatus');
    Route::get('getDeliveryForOrder/{id}',[\App\Http\Controllers\Admin\Order\NewOrderController::class,'getDeliveryForOrder'])->name('admin.getDeliveryForOrder');
    Route::post('insertingDeliveryForOrder/{id}',[\App\Http\Controllers\Admin\Order\NewOrderController::class,'insertingDeliveryForOrder'])->name('admin.insertingDeliveryForOrder');
    Route::get('orderDetails/{id}',[\App\Http\Controllers\Admin\Order\NewOrderController::class,'orderDetails'])->name('admin.orderDetails');


    Route::resource('deliveryConvertedOrders', \App\Http\Controllers\Admin\Order\DeliveryConvertedOrderController::class);//setting
    Route::get('changeStatusForOrder/{id}',[\App\Http\Controllers\Admin\Order\DeliveryConvertedOrderController::class,'changeStatusForOrder'])->name('admin.changeStatusForOrder');
    Route::post('changeStatusForOrder_store/{id}',[\App\Http\Controllers\Admin\Order\DeliveryConvertedOrderController::class,'changeStatusForOrder_store'])->name('admin.changeStatusForOrder_store');

    Route::resource('totalDeliveryOrders', \App\Http\Controllers\Admin\Order\TotalDeliveryOrderController::class);//setting

    Route::resource('partialDeliveryOrders', \App\Http\Controllers\Admin\Order\PartialDeliveryOrderController::class);//setting

    Route::resource('notDeliveryOrders', \App\Http\Controllers\Admin\Order\NotDeliveryOrderController::class);//setting


    ### activities
    Route::resource('activities',App\Http\Controllers\Admin\ActivityController::class);

    ### settings
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);//setting


    #reports

    Route::resource('deliversReports', \App\Http\Controllers\Admin\Reports\DeliveryReportsController::class);//setting


    Route::resource('tradersReports', \App\Http\Controllers\Admin\Reports\TraderReportsController::class);//setting

    Route::resource('todayOrdersReports', \App\Http\Controllers\Admin\Reports\TodayOrdersReportsController::class);//setting
    
    Route::post('custom_insert',[\App\Http\Controllers\Admin\RepositoryController::class,'custom_insert'])->name('custom_insert');
    
Route::post('custom_update',[\App\Http\Controllers\Admin\RepositoryController::class,'custom_update'])->name('custom_update');
   



});
