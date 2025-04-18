<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementUsercontroller;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\CheckAge;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\backend\PengalamanKerjaController;
use App\Http\Controllers\backend\PendidikanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ApiPendidikanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\backend\DashboardController as BackendDashboardController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//Acara 3
Route::get('/index', function () {
    return view('welcome');
});
Route::get('/user', [UserController::class, 'index']);

Route::match(['get', 'post'], '/', function () {
    return 'ini match';
});
Route::any('/', function () {
    return 'ini any';
});
Route::redirect('/here', 'there', 301);
Route::view('/welcome2', 'welcome');
Route::view('/welcome3', 'welcome')->name('Taylor');
Route::get('user/acara3/{name?}', function ($name = null) {
    return $name;
});
Route::get('user/acara3/{name?}', function ($name = "John") {
    return $name;
});
Route::get('user//acara3/{name}', function ($name) {

})->where('name', '[A-Za-z]+');
Route::get('user/{id}', function ($id) { })->where('id', '[0-9]+');
Route::get('user/{id}{name}', function ($id, $name) { })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
Route::get('user/{id}', function ($id) {
});
Route::get('search/{search}', function ($search) {
    return $search;
})->where('search', '.*');


//Acara 4
Route::get('/user/{id}/profile', function ($id) {
    return "Profil user dengan ID $id";
})->name('profile');

Route::get('/generate-url', function () {
    $url = route('profile', ['id' => 5]);
    return "URL ke profile: $url";
});

Route::get('/redirect-profile', function () {
    return redirect()->route('profile', ['id' => 5]);
});

Route::middleware(['first', 'second'])->group(function () {
    Route::get('/first', function () {
    });
    Route::get('/user/profile', function () {
    });
});
Route::
        namespace('Admin')->group(function () { });

Route::domain('{account).myapp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
    });
});
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
    });
});
Route::name('admin')->group(function () {
    Route::get('users', function () {
    })->name('users');
});

//Acara 5
Route::get('user', [ManagementUserController::class, 'index']);
Route::get('user/create', [ManagementUserController::class, 'create']);
Route::post('user', [ManagementUserController::class, 'store']);
Route::get('user/{id}', [ManagementUserController::class, 'show']);
Route::get('user/{id}/edit', [ManagementUserController::class, 'edit']);
Route::put('user/{id}', [ManagementUserController::class, 'update']);
Route::delete('user/{id}', [ManagementUserController::class, 'destroy']);

//Acara 6
Route::get('/home', [ManagementUserController::class, 'index']);

//Acara 7
Route::resource('/homeacara7', HomeController::class);
//Acara 8

Route::get('dashboard', [BackendDashboardController::class, 'index'])->name('dasboard.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//acara12
Route::get('/admin/profile1', function () {

})->middleware('auth');
Route::get('/1', function () {

})->middleware('first', 'second');
Route::get('/admin/profile2', function () {

})->middleware(CheckAge::class);

Route::get('/2', function () {

})->middleware('web');
Route::group(['middleware' => ['web']], function () { });
ROute::middleware(['web', 'subscribed'])->group(function () {

});
Route::put('post/{id}', function () {

})->middleware('role:editor');

//Acara 13-16
Route::group(['namespace' => 'App\Http\Controllers\backend'], function () {
    
    Route::resource('dashboard', 'DashboardController');
    Route::resource('pengalaman_kerja', PengalamanKerjaController::class);
    Route::resource('pendidikan', PendidikanController::class);
});

//Acara 17
Route::get('/session/create', [SessionController::class, 'create']);
Route::get('/session/show', [SessionController::class, 'show']);
Route::get('/session/delete', [SessionController::class, 'delete']);

Route::get('/pegawai/{nama}', [PegawaiController::class, 'index']);

Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);

//Acara 18
Route::get('/cobaerror/{nama?}', [CobaController::class, 'index']);

//Acara 19-20
Route::get('/upload', [UploadController::class, 'upload'])->name('upload');

Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');

Route::post('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');

Route::get('/dropzone', [UploadController::class, 'dropzone'])->name('dropzone');
Route::post('/dropzone/store', [UploadController::class, 'dropzone_store'])->name('dropzone.store');
Route::get('/pdf_upload', [UploadController::class, 'pdf_upload'])->name('pdf.upload');
Route::post('/pdf/store', [UploadController::class, 'pdf_store'])->name('pdf.store');

//Acara 21-22
Route::get('/api/pendidikan', [ApiPendidikanController::class, 'getAll']);
Route::get('/api/pendidikan/{id}', [ApiPendidikanController::class, 'getPen']);
Route::post('/api/pendidikan', [ApiPendidikanController::class, 'createPen']);
Route::put('/api/pendidikan/{id}', [ApiPendidikanController::class, 'updatePen']);
Route::delete('/api/pendidikan/{id}', [ApiPendidikanController::class, 'deletePen']);


