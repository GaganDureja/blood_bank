<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BloodController;
use App\Http\Controllers\BloodRequestController;
use Illuminate\Support\Facades\Auth;
use App\Models\All_blood;

use App\Http\Middleware\CheckIfAuthenticated;
use App\Http\Middleware\SendBloodRequest;
use App\Http\Middleware\HospitalRole;
use App\Http\Middleware\OnlyLogin;


Route::get('/', function () {
    $allBloodGroups = All_blood::orderBy('id', 'desc')->simplePaginate(8);
    return view('home', ['allBloodGroups' => $allBloodGroups]);
});

Route::get('/register',[RegisterController::class, 'index'])->middleware(CheckIfAuthenticated::class);
Route::post('/register',[RegisterController::class, 'register'])->middleware(CheckIfAuthenticated::class);


Route::get('/login', [LoginController::class, 'index'])->middleware(CheckIfAuthenticated::class);
Route::post('/login', [LoginController::class, 'login'])->middleware(CheckIfAuthenticated::class);

Route::get('/add-blood', [BloodController::class, 'index'])->middleware([OnlyLogin::class, HospitalRole::class]);
Route::post('/add-blood', [BloodController::class, 'add_blood'])->middleware([OnlyLogin::class, HospitalRole::class]);


Route::get('/blood-request',[BloodRequestController::class, 'index'])->middleware(OnlyLogin::class);
Route::get('/send-blood-request/{blood_id}', [BloodRequestController::class, 'add_request'])->middleware(SendBloodRequest::class);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->middleware(OnlyLogin::class);



