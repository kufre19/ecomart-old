<?php

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


/* 
undesignated routes
*/
Route::get("add_category",[App\Http\Controllers\UndesignatedController::class,"add_category"]);






Route::post("user/register",[\App\Http\Controllers\API\Register::class,"new_user"]);
Route::post("user/login",[App\Http\Controllers\API\Login::class,"login"]);
Route::get('unauthorized', function(){
            return response()->json(['message'=>'unauthorized','data'=>''],401);

})->name("unauthorized");
Route::any("test", function(){
    return "ok";
});


Route::get("search",[App\Http\Controllers\API\SearchController::class,"index"]);
Route::get("categories", [App\Http\Controllers\API\CategoriesController::class,"index"]);


Route::middleware('auth:sanctum')->group(function()
{
    Route::get('user/fetch', [App\Http\Controllers\API\Login::class,"fetch_auth_user"]);
    Route::post("user/logout",[App\Http\Controllers\API\Login::class,"logout"]);


});



