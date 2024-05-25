<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('profile', ProfileController::class)->name('profile');
Route::resource('employees', EmployeeController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/local-disk', function() {
    Storage::disk('local')->put('local-example.txt', 'This is local example
    content');
    return asset('storage/local-example.txt');
});
Route::get('/retrieve-local-file', function() {
    if (Storage::disk('local')->exists('local-example.txt')) {
    $contents = Storage::disk('local')->get('local-example.txt');
    } else {
    $contents = 'File does not exist';
    }
    return $contents;
});
Route::get('/retrieve-public-file', function() {
    if (Storage::disk('public')->exists('public-example.txt')) {
    $contents = Storage::disk('public')->get('public-example.txt');
    } else {
    $contents = 'File does not exist';
    }
    return $contents;
});
