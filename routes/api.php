<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\TemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'jwt.verify',], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group(['middleware' => 'jwt.verify'], function () {
    Route::prefix('template')->group(function () {
        Route::post('search',[TemplateController::class,'search']);
        Route::post('create',[TemplateController::class,'create']);
        Route::post('edit',[TemplateController::class,'edit']);
    });
    Route::prefix('site')->group(function () {
        Route::prefix('az')->group(function () {
            Route::post('/list', [SiteController::class, 'list'])->name('site.list');
            Route::post('/get-link', [SiteController::class, 'getLink'])->name('site.list');
        });
        Route::prefix('romprovider')->group(function () {
            Route::post('/list', [SiteController::class, 'list'])->name('site.list');
            Route::post('/get-link', [SiteController::class, 'getLink'])->name('site.list');
        });
    });
});
