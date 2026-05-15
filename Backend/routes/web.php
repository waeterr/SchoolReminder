<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserProfileController;


Route::get('/', function () {

    if(session()->has('user')){
        return redirect('/dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', function () {

    if(!session()->has('user')){
        return redirect('/login');
    }

    return view('dashboard');

});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Bagian ini sebaiknya dibungkus middleware 'auth' 
// supaya cuma orang yang sudah login yang bisa akses
Route::middleware('auth')->group(function () {
    
    // 1. Rute untuk nampilin halaman profil
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');

    // 2. Rute untuk proses simpan perubahan (Update)
    Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    
});

Route::post('/create-class', [
    ClassroomController::class,
    'create'
]);

Route::post('/join-class', [
    ClassroomController::class,
    'join'
]);

Route::post('/create-assignment', [
    AssignmentController::class,
    'create'
]);

Route::post('/submit-assignment', [
    SubmissionController::class,
    'submit'
]);

Route::get('/dashboard', function () {

    if(!session()->has('user')){
        return redirect('/login');
    }
    return view('dashboard');
});


Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/login');
});