<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\GoogleController;
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

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::group(['middleware' => ['auth']], function() {
	Route::get('/home', 'App\Http\Controllers\DashboardController@index');
	Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('home');
	Route::get('/users/profile', [UserController::class,'getProfile'])->name('profile');
	Route::post('/users/updateProfile', [UserController::class,'updateProfile'])->name('users.updateProfile');
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

	//Checklists
	Route::get('/checklist/all', 'App\Http\Controllers\Checklist\ChecklistController@getAll')->name('checklist.all');
	Route::get('/checklist', 'App\Http\Controllers\Checklist\ChecklistController@index')->name('checklist.index');
	Route::get('/checklist/create', 'App\Http\Controllers\Checklist\ChecklistController@create')->name('checklist.create');
	Route::post('/checklist', 'App\Http\Controllers\Checklist\ChecklistController@store')->name('checklist.store');
	Route::get('/checklist/edit/{id}', 'App\Http\Controllers\Checklist\ChecklistController@edit')->name('checklist.edit');
	Route::post('/checklist/update', 'App\Http\Controllers\Checklist\ChecklistController@update')->name('checklist.update');
	Route::get('/checklist/delete/{id}', 'App\Http\Controllers\Checklist\ChecklistController@delete')->name('checklist.delete');
	Route::get('/users/checklists/{user_id}', 'App\Http\Controllers\Checklist\ChecklistController@userChecklist')->name('users.checklists');
	Route::post('/users/checklists', 'App\Http\Controllers\Checklist\ChecklistController@saveUserChecklist')->name('users.checklists.save');

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
	Route::get('/nhr/view-progress/{id}', 'App\Http\Controllers\Nhr\NhrController@viewProgress')->name('nhr.view-progress');
	Route::get('/nhr/assign-candidate/{id}', 'App\Http\Controllers\Nhr\NhrController@assignCandidate')->name('nhr.assign-candidate');
	Route::get('/nhr/assign-refferal/{id}', 'App\Http\Controllers\Nhr\NhrController@assignRefferal')->name('nhr.assign-refferal');
	Route::post('/nhr/assign-refferal', 'App\Http\Controllers\Nhr\NhrController@saveAssignRefferal')->name('nhr.save.assign.refferal');
	Route::get('/nhr/assign-candidate/{nhr_id}/{candidate_id}', 'App\Http\Controllers\Nhr\NhrController@saveAssignCandidate')->name('nhr.save-assign-candidate');
	Route::get('/nhr/view-nhr-candidate-pregress/{nhr_id}/{candidate_id}', 'App\Http\Controllers\Nhr\NhrController@viewNHRCandidateProgress')->name('nhr.view-nhr-candidate-progress');
	Route::post('/nhr/interview-schedule', 'App\Http\Controllers\Nhr\NhrController@scheduleInterview')->name('nhr.interview.schedule');
	Route::post('/nhr/interview-edit', 'App\Http\Controllers\Nhr\NhrController@editInterview')->name('nhr.interview.edit');
	Route::get('/nhr/interview-delete/{interview_id}', 'App\Http\Controllers\Nhr\NhrController@deleteInterview')->name('nhr.interview.delete');
	Route::get('/nhr/select-candidate/{nhr_id}/{candidate_id}', 'App\Http\Controllers\Nhr\NhrController@selectNHRCandidate')->name('nhr.select-candidate');
	Route::get('/nhr/reopen/{nhr_id}', 'App\Http\Controllers\Nhr\NhrController@reopenNHR')->name('nhr.reopen');
	Route::get('/nhr/close/{nhr_id}', 'App\Http\Controllers\Nhr\NhrController@closeNHR')->name('nhr.final-close');

	//candidates
	Route::get('/candidates', 'App\Http\Controllers\Candidate\CandidateController@index')->name('candidates.index');
	Route::post('/candidates', 'App\Http\Controllers\Candidate\CandidateController@store')->name('candidates.store');
	Route::get('/candidates/edit/{id}', 'App\Http\Controllers\Candidate\CandidateController@edit')->name('candidates.edit');
	Route::get('/candidates/view/{id}', 'App\Http\Controllers\Candidate\CandidateController@view')->name('candidates.view');
	Route::post('/candidates/update', 'App\Http\Controllers\Candidate\CandidateController@update')->name('candidates.update');
	Route::get('/candidates/create', 'App\Http\Controllers\Candidate\CandidateController@create')->name('candidates.create');
	Route::get('/candidates/delete/{id}', 'App\Http\Controllers\Candidate\CandidateController@delete')->name('candidates.delete');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('employe', EmployeController::class);
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/send-email', 'App\Http\Controllers\UserController@sendemail');



