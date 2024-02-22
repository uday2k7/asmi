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

Route::middleware(\App\Http\Middleware\ApiHandler::class)->group(function(){
    // PUBLIC
    Route::any('/test', 'App\Http\Controllers\Api\PublicController@test');
    Route::any('/get-icons', 'App\Http\Controllers\Api\PublicController@getIcons');
    Route::any('/get-genders', 'App\Http\Controllers\Api\PublicController@getGenders');
    Route::any('/user/create', 'App\Http\Controllers\Api\UserController@create');
    Route::any('/user/login', 'App\Http\Controllers\Api\UserController@login');
    Route::any('/user/verify-mobile-send-otp', 'App\Http\Controllers\Api\UserController@verifyMobileSentOtp');
    Route::any('/user/verify-mobile-verify-otp', 'App\Http\Controllers\Api\UserController@verifyMobileVerifyOtp');
    Route::any('/user/reset-password-send-otp', 'App\Http\Controllers\Api\UserController@resetPasswordSentOtp');
    Route::any('/user/reset-password-verify-otp', 'App\Http\Controllers\Api\UserController@resetPasswordVerifyOtp');
    Route::any('/user/info-by-token', 'App\Http\Controllers\Api\UserController@infoByToken');
    Route::any('/page/about-us', 'App\Http\Controllers\Api\PublicController@aboutUsPage');
    Route::any('/page/terms-of-service', 'App\Http\Controllers\Api\PublicController@termsOfServicePage');
    Route::any('/page/privacy-policy', 'App\Http\Controllers\Api\PublicController@privacyPolicyPage');

    // AUTH REQUIRED
    Route::middleware(App\Http\Middleware\VerifyJWTToken::class)->group(function(){
        Route::any('/user/refresh-token', 'App\Http\Controllers\Api\UserController@refreshToken');
        Route::any('/user/myself', 'App\Http\Controllers\Api\UserController@myself');
        Route::any('/user/notification', 'App\Http\Controllers\Api\UserController@notification');
        Route::any('/user/profile-update', 'App\Http\Controllers\Api\UserController@profileUpdate');
        Route::any('/user/logout', 'App\Http\Controllers\Api\UserController@logout');

        Route::any('/log-book/create', 'App\Http\Controllers\Api\LogbookController@create');
        Route::any('/log-book/get-by-date', 'App\Http\Controllers\Api\LogbookController@getByDate');
    });
});
