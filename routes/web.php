<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TopUpController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('auth.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home.index');
    Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');
    Route::get('/top-up', [HomeController::class, 'topUp'])->name('home.topup');
    Route::get('/settings', [SettingController::class, 'index'])->name('home.settings');
    Route::get('/detail/{user}', [HomeController::class, 'detail'])->name('home.detail');

    Route::post('/settings', [SettingController::class, 'setAccountVisible'])->name('settings.visible');
    Route::post('/update-password', [SettingController::class, 'updatePassword'])->name('password.update');
    Route::post('/update-profile', [SettingController::class, 'updateProfile'])->name('profile.update');
    Route::get('/top-up/{amount}', [TopUpController::class, 'add'])->name('topup.add');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/friend-request/{friend}/{user}', [FriendController::class, 'sendRequest'])->name('friend.sendRequest');
    Route::get('accept-request/{user}/{friend}', [FriendController::class, 'acceptRequest'])->name('friend.acceptRequest');
    Route::get('remove-friend/{user}/{friend}', [FriendController::class, 'removeFriend'])->name('friend.removeFriend');
});
