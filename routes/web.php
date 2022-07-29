<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Livewire\Messages;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Nop;

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

Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('logout', 'destroy')->name('admin.logout');
        Route::get('profile', 'profile')->name('admin.profile');
        Route::get('storeprofile', 'storeprofile')->name('admin.storeprofile');
        Route::get('changepassword', 'Changepassword')->name('admin.changepassword');
        Route::post('updateprofile', 'updateprofile')->name('admin.updateprofile');
        Route::post('uploadImage', 'uploadImage')->name('admin.uploadImage');
        Route::get('dashboard', 'dashboard')->name('admin.dashboard');
        Route::post('updatepassword', 'updatepassword')->name('admin.updatepassword');
    });
    // Route::controller(Messages::class)->group(function () {
    //     Route::get('chat', 'render')->name('admin.chat');
    // });
    Route::get('chat', function () {
        return view('Backend.users.messages');
    });
    // Route::delete("/destroy/{id}", [CategoryController::class, "destroy"])->name("category.destroy");
    Route::resource('category', CategoryController::class);
    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories/trashed', 'trashed')->name('categories.trashed');
        Route::get('categories/restore/{id}', 'restore')->name('categories.restore');
        Route::get('categories/forceDelete/{id}', 'forceDelete')->name('categories.forceDelete');
    });
    Route::resource('supplier', SupplierController::class);
    Route::resource('product', ProductController::class);
    Route::controller(ProductController::class)->group(function () {
        Route::get('product/trashed', 'trashed')->name('product.trashed');
        Route::get('product/restore/{id}', 'restore')->name('product.restore');
        Route::get('product/forceDelete/{id}', 'forceDelete')->name('product.forceDelete');
        Route::get('get-category', 'getCategory')->name('get-category');
    });
    Route::resource('roles', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('employee', EmployeeController::class);

    Route::get('cart/index', [HomeController::class, 'index'])->name('showproduct');
    Route::get('cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('update-cart', [HomeController::class, 'update'])->name('update.cart');
    Route::delete('remove-from-cart', [HomeController::class, 'remove'])->name('remove.from.cart');
    Route::get('/notification/create',[NotificationController::class,'create'])->name('notification.create');
    Route::post('/notification/store',[NotificationController::class,'store'])->name('notification.store');
    Route::get('/notification/readed/{id}',[NotificationController::class,'readed'])->name('notification.readed');

});

require __DIR__ . '/auth.php';
