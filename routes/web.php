<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeesCategorieController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\RegisterController;

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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('employees', [EmployeeController::class, 'index'])->name("employees");
Route::post('employees', [EmployeeController::class, 'index']);
Route::post("/employee/update/{id}", [EmployeeController::class, "update"]);

Route::delete("employee/{id}", [EmployeeController::class, 'destroy']);
Route::post('employee', [EmployeeController::class, 'store'])->name('store-employee');

Route::get("category/", [EmployeesCategorieController::class, 'index'])->name('category');
Route::post("category/", [EmployeesCategorieController::class, 'index']);
Route::post('category/create', [EmployeesCategorieController::class, "store"])->name("store-category");
Route::delete('category/{id}',[EmployeesCategorieController::class , "destroy"]);

// Login routes
Route::get('login', [LoginController::class, 'loginForm'])->name("login");
Route::post('login', [LoginController::class, 'login'])->name("loginUser");
Route::get("logout", [LoginController::class, 'logout'])->name('logout');
