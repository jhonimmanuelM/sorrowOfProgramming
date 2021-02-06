<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeController;

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


Auth::routes();


Route::group(['middleware' => ['auth']], function() {

	Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('home');

	//Seting.Skills
	Route::get('/skills', 'App\Http\Controllers\Setting\SkillController@index')->name('skills.index');
	Route::post('/skills', 'App\Http\Controllers\Setting\SkillController@store')->name('skills.store');
	Route::get('/skills/edit/{id}', 'App\Http\Controllers\Setting\SkillController@edit')->name('skills.edit');
	Route::post('/skills/update', 'App\Http\Controllers\Setting\SkillController@update')->name('skills.update');
	Route::get('/skills/create', 'App\Http\Controllers\Setting\SkillController@create')->name('skills.create');
	Route::get('/skills/delete/{id}', 'App\Http\Controllers\Setting\SkillController@delete')->name('skills.delete');

	//Setting.Positions
	Route::get('/positions', 'App\Http\Controllers\Setting\PositionController@index')->name('positions.index');
	Route::post('/positions', 'App\Http\Controllers\Setting\PositionController@store')->name('positions.store');
	Route::get('/positions/edit/{id}', 'App\Http\Controllers\Setting\PositionController@edit')->name('positions.edit');
	Route::post('/positions/update', 'App\Http\Controllers\Setting\PositionController@update')->name('positions.update');
	Route::get('/positions/create', 'App\Http\Controllers\Setting\PositionController@create')->name('positions.create');
	Route::get('/positions/delete/{id}', 'App\Http\Controllers\Setting\PositionController@delete')->name('positions.delete');
	
	//Setting.Positions
	Route::get('/teams', 'App\Http\Controllers\Setting\TeamController@index')->name('teams.index');
	Route::post('/teams', 'App\Http\Controllers\Setting\TeamController@store')->name('teams.store');
	Route::get('/teams/edit/{id}', 'App\Http\Controllers\Setting\TeamController@edit')->name('teams.edit');
	Route::post('/teams/update', 'App\Http\Controllers\Setting\TeamController@update')->name('teams.update');
	Route::get('/teams/create', 'App\Http\Controllers\Setting\TeamController@create')->name('teams.create');
	Route::get('/teams/delete/{id}', 'App\Http\Controllers\Setting\TeamController@delete')->name('teams.delete');

	//Refferals
	Route::get('/referrals/all', 'App\Http\Controllers\Referal\ReferalController@getAll')->name('referrals.all');
	Route::get('/referrals', 'App\Http\Controllers\Referal\ReferalController@index')->name('referrals.index');
	Route::get('/referrals/create', 'App\Http\Controllers\Referal\ReferalController@create')->name('referrals.create');
	Route::post('/referrals', 'App\Http\Controllers\Referal\ReferalController@store')->name('referrals.store');
	Route::get('/referrals/edit/{id}', 'App\Http\Controllers\Referal\ReferalController@edit')->name('referrals.edit');
	Route::post('/referrals/update', 'App\Http\Controllers\Referal\ReferalController@update')->name('referrals.update');
	Route::get('/referrals/delete/{id}', 'App\Http\Controllers\Referal\ReferalController@delete')->name('referrals.delete');

	//NHR
	Route::get('/nhr/all', 'App\Http\Controllers\Nhr\NhrController@getAll')->name('nhr.all');
	Route::get('/nhr', 'App\Http\Controllers\Nhr\NhrController@index')->name('nhr.index');
	Route::get('/nhr/create', 'App\Http\Controllers\Nhr\NhrController@create')->name('nhr.create');
	Route::post('/nhr', 'App\Http\Controllers\Nhr\NhrController@store')->name('nhr.store');
	Route::get('/nhr/edit/{id}', 'App\Http\Controllers\Nhr\NhrController@edit')->name('nhr.edit');
	Route::post('/nhr/update', 'App\Http\Controllers\Nhr\NhrController@update')->name('nhr.update');
	Route::get('/nhr/delete/{id}', 'App\Http\Controllers\Nhr\NhrController@delete')->name('nhr.delete');
	Route::get('/nhr/assign-recruiter/{id}', 'App\Http\Controllers\Nhr\NhrController@assignRecruiter')->name('nhr.assign-recruiter');
	Route::post('/nhr/assign-recruiter', 'App\Http\Controllers\Nhr\NhrController@saveAssignRecruiter')->name('nhr.assigned-recruiter');

	//candidates
	Route::get('/candidates', 'App\Http\Controllers\Candidate\CandidateController@index')->name('candidates.index');
	Route::post('/candidates', 'App\Http\Controllers\Candidate\CandidateController@store')->name('candidates.store');
	Route::get('/candidates/edit/{id}', 'App\Http\Controllers\Candidate\CandidateController@edit')->name('candidates.edit');
	Route::post('/candidates/update', 'App\Http\Controllers\Candidate\CandidateController@update')->name('candidates.update');
	Route::get('/candidates/create', 'App\Http\Controllers\Candidate\CandidateController@create')->name('candidates.create');
	Route::get('/candidates/delete/{id}', 'App\Http\Controllers\Candidate\CandidateController@delete')->name('candidates.delete');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('employe', EmployeController::class);
});