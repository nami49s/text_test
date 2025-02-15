<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Controllers\ContactController;

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
// ユーザー登録関連
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// ログイン関連
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// 管理画面（認証が必要）
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::delete('/admin/contact/delete/{contactId}', [AdminController::class, 'destroy'])->name('admin.contact.delete');
});

// お問い合わせ関連
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');