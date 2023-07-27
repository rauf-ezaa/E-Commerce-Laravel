<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\AuthenticateController;

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



// // Route::get('/', [HomeController::class,'index']);

// Route::get('/', [HomeController::class,'indexTes']);
// Route::get('/login', [HomeController::class,'getPageLogin']);
// Route::post('/login-process', [AuthenticateController::class,'login'])->name('loginaction');
// Route::post('/register-process', [AuthenticateController::class,'register'])->name('registeraction');
// //Route::get('/', [HomeController::class,'info']);

// //Route Pesan
// Route::get('pesan/{id}', [PesanController::class,'index']);
// Route::post('pesan/{id}', [PesanController::class,'pesan']);

// route::group(['prefix'=>'admin','middleware'=>['auth'], 'as' => 'admin'], function(){
//     Route::resource('/products', App\Http\Controllers\ProductController::class);
// });


//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    
    Route::get('/login', [HomeController::class, 'halamanlogin'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'dologin'])->name('loginact');
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/register', [HomeController::class, 'halamanregister'])->name('register');
    Route::post('/register', [AuthenticateController::class, 'doregister'])->name('registeraction');
    Route::get('/makanan', [HomeController::class, 'halmakanan'])->name('home_makanan');
    
});

// untuk superadmin dan pegawai
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function() {
    Route::get('/logout', [AuthenticateController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


// untuk admin
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::resource('/products', App\Http\Controllers\ProductController::class);
});

// untuk customer
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/shopper', [HomeController::class, 'index'])->name('home');
    Route::get('pesan/{id}', [CustomerController::class,'index']);
    Route::post('pesan/{id}', [PesanController::class,'pesan'])->name('pesanact');
    
    Route::get('check-out', [PesanController::class,'check']);
    Route::delete('check-out/{id}', [PesanController::class,'delete'])->name('delete');
    Route::get('konfirmasi', [PesanController::class,'konfirmasi'])->name('konfirmasi');

    Route::get('history', [HistoryController::class,'index'])->name('history');
    Route::get('history/{id}', [HistoryController::class,'detail']);

    // Route::get('history', 'HistoryController@index');
    // Route::get('history/{id}', 'HistoryController@detail');

    Route::get('/makanan', [HomeController::class,'makanan']); 

    Route::get('/tes', [HomeController::class, 'checkout']);
});

