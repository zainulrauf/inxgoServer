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

Route::get('migrate', function () {
    \Artisan::call('migrate');
    \Artisan::call('db:seed');
    dd("migrate run");

});
Route::get('cache', function () {
    \Artisan::call('cache:ca');
    dd("cache");
});
Route::get('passport', function () {
    \Artisan::call('passport:install');
    dd("passport");
});
Route::get('/dashboard', 'UserAPIController@dashboard');
Route::post('/login', 'UserAPIController@login');
Route::post('/image/upload', 'UserAPIController@imageUpload');
// Route::middleware('gate')->group(function () {
    Route::get('promotion', 'PromotionAPIController@index');
    Route::any('promotionedit', 'PromotionAPIController@edit');
    Route::any('promotion-save', 'PromotionAPIController@store');
    Route::post('promotion/delete', 'PromotionAPIController@delete');
	
	Route::prefix('user')->group(function () {
	    Route::get('/', 'UserAPIController@index');
	    Route::post('/{id}', 'UserAPIController@edit');
	    Route::post('/', 'UserAPIController@update');
	    Route::post('/delete', 'UserAPIController@delete');
	});
	

 	Route::get('/address/get/{id}', 'UserAddressAPIController@index');
    Route::any('/address/edit/{id}', 'UserAddressAPIController@update');
    Route::any('/address/store', 'UserAddressAPIController@store');
    Route::any('/address/delete', 'UserAddressAPIController@delete');
	Route::prefix('role')->group(function () {
	    Route::get('/', 'RoleAPIController@index');
	    Route::get('/{id}', 'RoleAPIController@edit');
	    Route::post('/', 'RoleAPIController@update');
	    Route::post('/delete', 'RoleAPIController@delete');
	});
	Route::prefix('permision')->group(function () {
	    Route::get('/', 'PermisionAPIController@index');
	    Route::post('/', 'PermisionAPIController@update');
	    Route::post('/delete', 'PermisionAPIController@delete');
	});
	Route::prefix('role')->group(function () {
	    Route::post('/permision', 'PermisionRoleAPIController@rolePermision');
	    Route::get('/permision/{id}', 'PermisionRoleAPIController@getrolePermision');
	    Route::post('/user', 'PermisionRoleAPIController@roleUser');
	});
	Route::prefix('ServiceType')->group(function () {
	    Route::post('/delete', 'SkillsTypeController@delete');
	});
	Route::prefix('/')->group(function () {
		Route::any('skill', 'SkillsController@index');
	    Route::post('Skill/update', 'SkillsController@update');
	    Route::post('skills/delete', 'SkillsController@delete');
	});
	Route::prefix('ticket')->group(function () {
		Route::prefix('/issue')->group(function () {
		    Route::any('/list', 'Ticket\TicketAPIController@index');
		    Route::get('/{id}', 'Ticket\TicketAPIController@edit');
		    Route::post('/', 'Ticket\TicketAPIController@update');
		    Route::post('/delete', 'Ticket\TicketAPIController@delete');
	    });
		Route::prefix('/status')->group(function () {
		    Route::get('/', 'Ticket\TicketStatusAPIController@index');
		    Route::get('/{id}', 'Ticket\TicketStatusAPIController@edit');
		    Route::post('/', 'Ticket\TicketStatusAPIController@update');
		    Route::post('/delete', 'Ticket\TicketStatusAPIController@delete');
		});
		Route::prefix('/type')->group(function () {
		    Route::get('/', 'Ticket\TicketTypeAPIController@index');
		    Route::get('/{id}', 'Ticket\TicketTypeAPIController@edit');
		    Route::post('/', 'Ticket\TicketTypeAPIController@update');
		    Route::post('/delete', 'Ticket\TicketTypeAPIController@delete');
		});
	});
// });

