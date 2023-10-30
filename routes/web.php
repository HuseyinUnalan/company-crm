<?php

use App\Http\Controllers\Admin\CalculateController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProductCategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\UserIBANController;
use App\Http\Controllers\Frontend\IndexController as FrontendIndexController;
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
        Route::get('/dashboard',  'Index')->name('dashboard');

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
        Route::middleware('can:access-customer')->group(function () {
            Route::get('/all/products', 'AllProducts')->name('all.products');
            Route::get('/add/product', 'AddProduct')->name('add.product');
            Route::post('store/product', 'StoreProduct')->name('store.product');
            Route::get('edit/product/{id}',  'EditProduct')->name('edit.product');
            Route::post('update/product',  'UpdateProduct')->name('update.product');
            Route::get('delete/product/{id}', 'DeleteProduct')->name('delete.product');
            Route::get('add/product/excel', 'AddProductExcel')->name('add.product.excel');
            Route::post('store/product/excel', 'StoreProductExcel')->name('store.product.excel');
            Route::get('product/export/',  'export')->name('export.product.excel');
            Route::post('/updateDiscount', 'updateDiscount')->name('update.discount');
        });
    });

    // Admin Product Categories Route
    Route::controller(ProductCategoriesController::class)->group(function () {
        Route::middleware('can:access-customer')->group(function () {
            Route::get('/all/product/categories', 'AllProductCategories')->name('all.product.categories');
            Route::get('/add/product/category', 'AddProductCategory')->name('add.product.category');
            Route::post('store/product/category', 'StoreProductCategory')->name('store.product.category');
            Route::get('edit/product/category/{id}',  'EditProductCategory')->name('edit.product.category');
            Route::post('update/product/categort',  'UpdateProductCategory')->name('update.product.category');
            Route::get('delete/product/category/{id}', 'DeleteProductCategory')->name('delete.product.category');
        });
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
        Route::get('add/customer/excel', 'AddCustomerExcel')->name('add.customer.excel');
        Route::post('store/customer/excel', 'StoreCustomerExcel')->name('store.customer.excel');
        Route::get('customer/export/',  'export')->name('export.customer.excel');

        // });
    });

    Route::controller(CalculateController::class)->group(function () {
        Route::get('calculate', 'Calculate')->name('calculate');
        Route::post('store/calculate', 'StoreCalculate')->name('store.calculate');
        Route::get('my/offers', 'MyOffers')->name('my.offers');
        Route::get('detail/offer/{id}/{user_id}', 'DetailOffer')->name('detail.offer');
        Route::get('delete/offer/{id}', 'DeleteOffer')->name('delete.offer');
        Route::get('print/invoice/{id}', 'PrintInvoice')->name('print.invoice');
        Route::get('/download-pdf/{id}', 'DownloadInvoicePdf')->name('download.invoice.pdf');


        Route::post('/send-invoice', 'SendMail')->name('send.invoice.mail');
    });


    Route::controller(UserIBANController::class)->group(function () {
        Route::get('/all/user/iban', 'AllUserIBAN')->name('all.user.iban');
        Route::get('/add/user/iban', 'AddUserIBAN')->name('add.user.iban');
        Route::post('store/user/iban', 'StoreUserIBAN')->name('store.user.iban');
        Route::get('edit/user/iban/{id}',  'EditUserIBAN')->name('edit.user.iban');
        Route::post('update/user/iban',  'UpdateUserIBAN')->name('update.user.iban');
        Route::get('delete/user/iban/{id}', 'DeleteUserIBAN')->name('delete.user.iban');
    });

    Route::get('/get-product-details/{id}', [CalculateController::class, 'getProductDetailsAjax']);


    Route::controller(SuperAdminController::class)->prefix('super/admin/')->group(function () {
        // Gate kontrolü eklemek için can yöntemini kullanın
        Route::middleware('can:access-customer')->group(function () {
            Route::get('all/customers', 'AllCustomers')->name('super.admin.all.customers');
            Route::get('all/products', 'AllProducts')->name('super.admin.all.products');
            Route::get('all/users', 'AllUsers')->name('super.admin.all.users');
            Route::get('all/offers', 'AllOffers')->name('super.admin.all.offers');

            // Admin Settings 
            Route::get('settings/edit', 'SettingsEdit')->name('settings.edit');
            Route::post('settings/store', 'SettingsStore')->name('settings.store');
            // Admin About 
            Route::get('/edit/about', 'EditAbout')->name('edit.about');
            Route::post('/update/about', 'UpdateAbout')->name('update.about');
            // Admin Slider 
            Route::get('all/slider', 'AllSlider')->name('all.slider');
            Route::get('add/slider', 'AddSlider')->name('add.slider');
            Route::post('store/slider', 'StoreSlider')->name('store.slider');
            Route::get('edit/slider/{id}', 'EditSlider')->name('edit.slider');
            Route::post('update/slider', 'UpdateSlider')->name('update.slider');
            Route::get('delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
            Route::get('slider/inactive/{id}', 'SliderInactive')->name('slider.inactive');
            Route::get('slider/active/{id}', 'SliderActive')->name('slider.active');
            // Admin Blog 
            Route::get('all/blog', 'AllBlog')->name('all.blog');
            Route::get('add/blog', 'AddBlog')->name('add.blog');
            Route::post('store/blog', 'StoreBlog')->name('store.blog');
            Route::get('edit/blog/{id}', 'EditBlog')->name('edit.blog');
            Route::post('update/blog', 'UpdateBlog')->name('update.blog');
            Route::get('delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
            Route::get('blog/inactive/{id}', 'BlogInactive')->name('blog.inactive');
            Route::get('blog/active/{id}', 'BlogActive')->name('blog.active');
        });
        Route::get('detail/user/{id}', 'DetailUser')->name('detail.user');
    });




    Route::controller(FrontendIndexController::class)->group(function () {
        Route::get('/teklif/hazirla', 'AddOffer')->name('add.offer');
    });
});


Route::controller(FrontendIndexController::class)->group(function () {
    Route::get('/', 'Index')->name('/');

    Route::get('/hakkimizda',  'HomeAbout')->name('home.about');
    Route::get('/bloglar',  'HomeBlog')->name('home.blogs');

    Route::get('/iletisim', 'HomeContact')->name('home.contact');
    Route::post('/store/message', 'StoreMesseage')->name('store.message');

    Route::get('/blog/{slug}',  'BlogDetail')->name('blog.details');
});
