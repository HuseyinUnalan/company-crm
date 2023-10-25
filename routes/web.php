<?php

use App\Http\Controllers\Admin\CalculateController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Middleware\CheckUserStatus;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['user'])->group(function () { // Kernel.php de yol eklendi




    // Admin All Route 
    Route::controller(IndexController::class)->group(function () {
        Route::get('/',  'Index')->name('/');

        Route::get('admin/logout', 'logout')->name('admin.logout');
        //Change Profile Page
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');

        //Update Admin Password Page
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
    });

    // Admin Products Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/products', 'AllProducts')->name('all.products');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('store/product', 'StoreProduct')->name('store.product');
        Route::get('edit/product/{id}',  'EditProduct')->name('edit.product');
        Route::post('update/product',  'UpdateProduct')->name('update.product');
        Route::get('delete/product/{id}', 'DeleteProduct')->name('delete.product');
    });


    Route::controller(CustomerController::class)->group(function () {
        // Gate kontrolü eklemek için can yöntemini kullanın
        // Route::middleware('can:access-customer')->group(function () {
        Route::get('/all/customers', 'AllCustomers')->name('all.customers');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('store/customer', 'StoreCustomer')->name('store.customer');


        Route::get('edit/customer/{id}',  'EditCustomer')->name('edit.customer');
        Route::post('update/customer',  'UpdateCustomer')->name('update.customer');
        Route::get('delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');
        // });
    });

    Route::controller(CalculateController::class)->group(function () {
        Route::get('calculate', 'Calculate')->name('calculate');
        Route::post('store/calculate', 'StoreCalculate')->name('store.calculate');
        Route::get('my/offers', 'MyOffers')->name('my.offers');
        Route::get('detail/offer/{id}/{user_id}', 'DetailOffer')->name('detail.offer');
        Route::get('delete/offer/{id}', 'DeleteOffer')->name('delete.offer');

    });

    Route::get('/get-product-details/{id}', [CalculateController::class, 'getProductDetailsAjax']);


});
