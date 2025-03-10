<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;



Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::get('/list_room', [DashboardController::class, 'list_room'])->name('list_room');
Route::get('/coba', function() {
    return User::all();
});

// kalau ada middleware auth harus login dahulu baru bisa masuk ke halaman tersebut.
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/my_profile', [DashboardController::class, 'myProfile'])->name('my_profile');
    Route::put('/my_profile', [DashboardController::class, 'myProfilePost'])->name('myprofilepost');
    Route::get('/booking_room', [DashboardController::class, 'bookingRoom'])->name('booking_room');
    Route::get('/dashboard/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/dashboard/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::post('/dashboard/bookings/getprice', [BookingController::class, 'getprice'])->name('getprice');
    Route::delete('/dashboard/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::get('/cetakreservasi/{id}', [BookingController::class, 'cetakReservasi'])->name('bookings.cetakReservasi');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::middleware(['role:2,3'])->group(function() {
        /* 
        
        Route::resource digunakan untuk membuat serangkaian route otomatis untuk menangani operasi CRUD (Create, Read, Update, Delete) pada resource tertentu, seperti data pengguna, produk, atau lainnya.
        
        Ketika Anda menggunakan Route::resource('resource-name', ControllerName::class), Laravel akan otomatis menghasilkan 7 route berikut:
        
        GET	        /resource-name	            index	    resource-name.index	    Menampilkan daftar semua resource.
        GET	        /resource-name/create	    create	    resource-name.create	Menampilkan form untuk membuat data.
        POST	    /resource-name	            store	    resource-name.store	    Menyimpan data baru ke database.
        GET	        /resource-name/{id}	        show	    resource-name.show	    Menampilkan detail resource tertentu.
        GET	        /resource-name/{id}/edit	edit	    resource-name.edit	    Menampilkan form untuk edit data.
        PUT/PATCH	/resource-name/{id}	        update	    resource-name.update	Memperbarui data di database.
        DELETE	    /resource-name/{id}	        destroy	    resource-name.destroy	Menghapus data dari database.

        jika ada except maka kecuali view itu yang tidak ditampilkan
        jika ada only maka hanya view itu yang ditampilkan
        
        */
        Route::get('/histories', [DashboardController::class, 'history'])->name('history');
        Route::get('/dashboard/bookings', [BookingController::class, 'index'])->name('bookings.index');
        
        
        Route::middleware(['role:3'])->group(function() {
            Route::resource('/dashboard/rooms', RoomController::class, [
                'as' => '' // Menghilangkan prefix dari penamaan route
                ])->except(['show']); // show tidak diperlukan

            Route::resource('/dashboard/categories', CategoryController::class, [
                'as' => '' // Menghilangkan prefix dari penamaan route
            ])->except(['show']); // show tidak diperlukan

            Route::resource('/dashboard/users', UserController::class, [
                'as' => '' // Menghilangkan prefix dari penamaan route
            ])->except(['show']); // show tidak diperlukan

            Route::resource('/dashboard/roles', RoleController::class, [
                'as' => '' // Menghilangkan prefix dari penamaan route
            ])->except(['show']); // show tidak diperlukan
        
        });
        // Route::resource('/dashboard/bookings', BookingController::class, [
        //     'as' => '' // Menghilangkan prefix dari penamaan route
        // ])->except(['show', 'create', 'store']); // show tidak diperlukan


    });
});

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');
    
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');
});

