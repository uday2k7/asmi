<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\LoginController;

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

Route::get('/', function () {
    return view('welcome');
});

// PUBLIC CONTROLLERS (NO AUTH REQUIRED)
Route::any('/', 'App\Http\Controllers\WebPublic\HomeController@index');
Route::get('about-us', 'App\Http\Controllers\WebPublic\HomeController@aboutUs');
Route::get('contact-us', 'App\Http\Controllers\WebPublic\HomeController@contactUs');
Route::post('contact-us/send', 'App\Http\Controllers\WebPrivate\ContactController@store');
Route::get('services/{id}', 'App\Http\Controllers\WebPublic\ServiceController@services');
Route::get('portfolio', 'App\Http\Controllers\WebPublic\PortfolioController@index');
//Route::get('/campaign-influencer-invoice/{campaignUserRowId}', 'App\Http\Controllers\WebPublic\CampaignController@campaignInvoice');

Route::get('cpanel/login', 'App\Http\Controllers\LoginController@superadminindex');
Route::post('cpanel/login', 'App\Http\Controllers\LoginController@superDoLogin');
Route::get('cpanel/logout', 'App\Http\Controllers\LoginController@logout');


// SUPER ADMIN
Route::middleware(App\Http\Middleware\RoleSuperAdmin::class)->group(function(){
    Route::get('cpanel/user', 'App\Http\Controllers\WebPrivate\UserController@index');
    /*Route::get('cpanel/organization/list', 'App\Http\Controllers\WebPrivate\UserController@index');
    Route::get('cpanel/organization/add', 'App\Http\Controllers\WebPrivate\UserController@add');
    Route::post('cpanel/organization/store', 'App\Http\Controllers\WebPrivate\UserController@store');
    Route::get('cpanel/genre/list', 'App\Http\Controllers\WebPrivate\GenreController@index');
    Route::get('cpanel/genre/add', 'App\Http\Controllers\WebPrivate\GenreController@add');
    Route::post('cpanel/genre/store', 'App\Http\Controllers\WebPrivate\GenreController@store');

    // ABOUT MANAGEMENT
    Route::get('cpanel/about/index', 'App\Http\Controllers\WebPrivate\AboutController@index');
    Route::get('cpanel/about/edit/{id}', 'App\Http\Controllers\WebPrivate\AboutController@edit');
    Route::post('cpanel/about/update', 'App\Http\Controllers\WebPrivate\AboutController@update');

    // TERMS MANAGEMENT
    Route::get('cpanel/terms/index', 'App\Http\Controllers\WebPrivate\TermsController@index');
    Route::get('cpanel/terms/edit/{id}', 'App\Http\Controllers\WebPrivate\TermsController@edit');
    Route::post('cpanel/terms/update', 'App\Http\Controllers\WebPrivate\TermsController@update');

    // PRIVACY MANAGEMENT
    Route::get('cpanel/privacy/index', 'App\Http\Controllers\WebPrivate\PrivacyController@index');
    Route::get('cpanel/privacy/edit/{id}', 'App\Http\Controllers\WebPrivate\PrivacyController@edit');
    Route::post('cpanel/privacy/update', 'App\Http\Controllers\WebPrivate\PrivacyController@update');

    //Emotions
    Route::get('cpanel/emotions', 'App\Http\Controllers\WebPrivate\EmotionsController@index');
    Route::get('cpanel/emotions/add', 'App\Http\Controllers\WebPrivate\EmotionsController@add');
    Route::post('cpanel/emotions/store', 'App\Http\Controllers\WebPrivate\EmotionsController@store');
    Route::get('cpanel/emotions/edit/{id}', 'App\Http\Controllers\WebPrivate\EmotionsController@edit');
    Route::post('cpanel/emotions/update', 'App\Http\Controllers\WebPrivate\EmotionsController@update');
    Route::get('cpanel/emotions/display/{id}', 'App\Http\Controllers\WebPrivate\EmotionsController@display');
    Route::get('cpanel/emotions/delete/{id}', 'App\Http\Controllers\WebPrivate\EmotionsController@delete');

    //Events
    Route::get('cpanel/events', 'App\Http\Controllers\WebPrivate\EventsController@index');
    Route::get('cpanel/events/add', 'App\Http\Controllers\WebPrivate\EventsController@add');
    Route::post('cpanel/events/store', 'App\Http\Controllers\WebPrivate\EventsController@store');
    Route::get('cpanel/events/edit/{id}', 'App\Http\Controllers\WebPrivate\EventsController@edit');
    Route::post('cpanel/events/update', 'App\Http\Controllers\WebPrivate\EventsController@update');
    Route::get('cpanel/events/display/{id}', 'App\Http\Controllers\WebPrivate\EventsController@display');
    Route::get('cpanel/events/delete/{id}', 'App\Http\Controllers\WebPrivate\EventsController@delete');

    //Emotions
    Route::get('cpanel/activities', 'App\Http\Controllers\WebPrivate\ActivitiesController@index');
    Route::get('cpanel/activities/add', 'App\Http\Controllers\WebPrivate\ActivitiesController@add');
    Route::post('cpanel/activities/store', 'App\Http\Controllers\WebPrivate\ActivitiesController@store');
    Route::get('cpanel/activities/edit/{id}', 'App\Http\Controllers\WebPrivate\ActivitiesController@edit');
    Route::post('cpanel/activities/update', 'App\Http\Controllers\WebPrivate\ActivitiesController@update');
    Route::get('cpanel/activities/display/{id}', 'App\Http\Controllers\WebPrivate\ActivitiesController@display');
    Route::get('cpanel/activities/delete/{id}', 'App\Http\Controllers\WebPrivate\ActivitiesController@delete');

    //Emotions
    Route::get('cpanel/log', 'App\Http\Controllers\WebPrivate\LogController@index');
    //Route::get('cpanel/activities/add', 'App\Http\Controllers\WebPrivate\ActivitiesController@add');
    //Route::post('cpanel/activities/store', 'App\Http\Controllers\WebPrivate\ActivitiesController@store');
    //Route::get('cpanel/activities/edit/{id}', 'App\Http\Controllers\WebPrivate\ActivitiesController@edit');
    //Route::post('cpanel/activities/update', 'App\Http\Controllers\WebPrivate\ActivitiesController@update');

    // TERMS MANAGEMENT
    Route::get('cpanel/contact/index', 'App\Http\Controllers\WebPrivate\ContactController@index');
    Route::get('cpanel/contact/edit/{id}', 'App\Http\Controllers\WebPrivate\ContactController@edit');
    Route::post('cpanel/contact/update', 'App\Http\Controllers\WebPrivate\ContactController@update');*/

    // BANNERS MANAGEMENT
    Route::get('cpanel/banner/home', 'App\Http\Controllers\WebPrivate\BannerController@home');
    Route::get('cpanel/banner/home/edit/{id}', 'App\Http\Controllers\WebPrivate\BannerController@homeedit');
    Route::post('cpanel/banner/home/update', 'App\Http\Controllers\WebPrivate\BannerController@homeupdate');
    Route::get('cpanel/banner/inner', 'App\Http\Controllers\WebPrivate\BannerController@inner');
    Route::get('cpanel/banner/inner/edit/{id}', 'App\Http\Controllers\WebPrivate\BannerController@inneredit');
    Route::post('cpanel/banner/inner/update', 'App\Http\Controllers\WebPrivate\BannerController@innerupdate');


    // CONTENT MANAGEMENT
    Route::get('cpanel/content/{id}', 'App\Http\Controllers\WebPrivate\ContentController@show');
    Route::get('cpanel/content/edit/{id}', 'App\Http\Controllers\WebPrivate\ContentController@edit');
    Route::post('cpanel/content/update', 'App\Http\Controllers\WebPrivate\ContentController@contentupdate');
    

    // SERVICE MANAGEMENT
    Route::get('cpanel/service/our-expertise', 'App\Http\Controllers\WebPrivate\ServiceController@our_expertise');
    Route::get('cpanel/service/our-expertise-edit/{id}', 'App\Http\Controllers\WebPrivate\ServiceController@our_expertise_edit');
    Route::post('cpanel/service/our-expertise-edit', 'App\Http\Controllers\WebPrivate\ServiceController@our_expertise_update');
    Route::get('cpanel/service/our-solutions', 'App\Http\Controllers\WebPrivate\ServiceController@our_solutions');
    
    Route::get('cpanel/service/our-solutions-edit/{id}', 'App\Http\Controllers\WebPrivate\ServiceController@our_solutions_edit');
    Route::post('cpanel/service/our-solutions-edit', 'App\Http\Controllers\WebPrivate\ServiceController@our_solutions_update');
    Route::get('cpanel/service/items-we-offered', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered');
    Route::get('cpanel/service/items-we-offered/add', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered_add');
    Route::post('cpanel/service/items-we-offered/store', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered_store');
    Route::get('cpanel/service/items-we-offered/details/{id}', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered_details');
    Route::get('cpanel/service/items-we-offered/details/add/{id}', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered_details_add');
    Route::post('cpanel/service/items-we-offered/details/store', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered_details_store');
    Route::get('cpanel/service/items-we-offered/details/edit/{id}/{item}', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered_details_edit');
    Route::post('cpanel/service/items-we-offered/details/update', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered_details_update');

    // PORTFOLIO MANAGEMENT
    Route::get('cpanel/portfolio/list', 'App\Http\Controllers\WebPrivate\PortfolioController@list');
    Route::get('cpanel/portfolio/add', 'App\Http\Controllers\WebPrivate\PortfolioController@add');
    Route::post('cpanel/portfolio/store', 'App\Http\Controllers\WebPrivate\PortfolioController@store');
    Route::get('cpanel/portfolio/details/{id}', 'App\Http\Controllers\WebPrivate\PortfolioController@details');
    Route::get('cpanel/portfolio/details/add/{id}', 'App\Http\Controllers\WebPrivate\PortfolioController@adddetails');
    Route::post('cpanel/portfolio/details/store', 'App\Http\Controllers\WebPrivate\PortfolioController@storedetails');
    Route::get('cpanel/portfolio/details/edit/{id}/{item}', 'App\Http\Controllers\WebPrivate\PortfolioController@editdetails');
    Route::post('cpanel/portfolio/details/update', 'App\Http\Controllers\WebPrivate\PortfolioController@updatedetails');
    //Routepostget('cpanel/service/our-expertise-edit/{id}', 'App\Http\Controllers\WebPrivate\ServiceController@our_expertise_edit');
   // Route::get('cpanel/service/medical-equipments', 'App\Http\Controllers\WebPrivate\ServiceController@medical_equipments');
    //Route::get('cpanel/service/items-we-offered', 'App\Http\Controllers\WebPrivate\ServiceController@items_we_offered');
   // Route::get('cpanel/content/edit/{id}', 'App\Http\Controllers\WebPrivate\ContentController@edit');
   // Route::post('cpanel/content/update', 'App\Http\Controllers\WebPrivate\ContentController@contentupdate');
    
});

