<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
  if (Auth::check()) {
    return redirect()->route('dashboard');
  }
  return redirect()->route('login');
});

// Dashboard Route (redirect /home to /dashboard)
Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// User Management Routes
Route::middleware(['auth', 'permission:users.view'])->group(function () {
  Route::get('/users', function () {
    return view('users.index');
  })->name('users.index');
});

// Role Management Routes  
Route::middleware(['auth', 'permission:roles.view'])->group(function () {
  Route::get('/roles', function () {
    return view('roles.index');
  })->name('roles.index');
});

// Profile Settings Routes
Route::middleware(['auth'])->group(function () {
  Route::get('/profile', function () {
    return view('profile.index');
  })->name('profile.index');
});

Auth::routes();

Route::get('/home', function () {
  return redirect()->route('dashboard');
})->middleware(['auth'])->name('home');
