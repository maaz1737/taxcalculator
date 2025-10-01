<?php

use App\Http\Controllers\ConvertController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LengthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\V1\FinanceController as F;
use App\Http\Controllers\V1\FitnessController;
use App\Http\Controllers\GoogleAuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [UserController::class, 'registerPost'])->name('registerPost');
Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout']);

// Route::view('/', 'length.index')->name('length');
Route::view('/area', 'area.area')->name('area');
Route::view('/weight', 'weight.weight')->name('weight');
Route::view('/temperature', 'temperature.temperature')->name('temperature');
Route::view('/time', 'time.time')->name('time');
Route::view('/volume', 'volume.volume')->name('volume');
Route::view('/mortgage', 'finance/mortgage')->name('page.mortgage');
Route::view('/auto', 'finance/auto')->name('page.auto');
Route::view('/loan', 'finance/loan')->name('page.loan');
Route::view('/rent', 'finance/rent')->name('page.rent');
Route::view('/tax', 'finance/tax')->name('page.tax');
Route::view('/salary', 'finance/salary')->name('page.salary');
Route::view('/depreciation', 'finance/depreciation')->name('page.depreciation');

Route::view('/rent', 'finance.rent')->name('finance.rent');

Route::view('/income-tax', 'finance.income-tax')->name('finance.income_tax');

Route::view('/salary', 'finance.salary')->name('finance.salary');
Route::prefix('fitness')->group(function () {
    Route::view('/', 'fitness.index')->name('fitness.index');
    Route::view('/bmi', 'fitness.bmi')->name('fitness.bmi');
    // Add other pages as you build them:
    // Route::view('/bmr-tdee', 'fitness.bmr_tdee')->name('fitness.bmr_tdee');
    // Route::view('/bodyfat', 'fitness.bodyfat')->name('fitness.bodyfat');
    // Route::view('/one-rep-max', 'fitness.orm')->name('fitness.orm');
    // Route::view('/heart-rate', 'fitness.hr')->name('fitness.hr');
    // Route::view('/calories', 'fitness.calories')->name('fitness.calories');
    // Route::view('/water', 'fitness.water')->name('fitness.water');
});


Route::get('/v1/calculations/recent', [FitnessController::class, 'recent']);


Route::view('/ss', 'scientificcalculator')->name('scientificcalculator');







Route::get('/convert', [ConvertController::class, 'convert'])->name('api.convert');
Route::get('/convert/table', [ConvertController::class, 'table'])->name('api.convert.table');








Route::prefix('v1/finance')->as('v1.finance.')->group(function () {
    Route::post('mortgage',      [F::class, 'mortgage'])->name('mortgage');
    Route::post('mortgagesave',      [F::class, 'mortgage_save'])->name('mortgagesave');
    Route::post('mortgageHistory',      [F::class, 'mortgageHistory'])->name('mortgageHistory');
    // Route::post('auto',          [F::class, 'auto'])->name('auto');                    
    // Route::post('loan',          [F::class, 'loan'])->name('loan');                     
    Route::post('rent',          [F::class, 'rent'])->name('rent');
    Route::post('/rentsave',          [F::class, 'rent_save'])->name('rent_save');
    Route::get('/rentHistory',          [F::class, 'rentHistory'])->name('rentHistory');
    Route::post('/income-tax', [F::class, 'tax'])->name('api.finance.income_tax');
    Route::post('/salary', [F::class, 'salary'])->name('api.finance.salary');
    Route::post('/salarysave', [F::class, 'save_salary'])->name('api.finance.save_salary');
    Route::get('/salaryhistory', [F::class, 'salaryhistory'])->name('api.finance.salaryhistory');
    Route::post('depreciation',  [F::class, 'depreciation'])->name('depreciation');
    Route::post('depreciationsave',  [F::class, 'depreciationSave'])->name('depreciationSave');
    Route::get('/DepreciationHistory',  [F::class, 'DepreciationHistory'])->name('DepreciationHistory');

    Route::get('/gettax', [F::class, 'getTax']);
});



Route::prefix('v1/fitness')->as('v1.fitness.')->group(function () {
    Route::post('bmi',       [FitnessController::class, 'bmi'])->name('api.fitness.bmi');
    Route::post('bmr',       [FitnessController::class, 'bmr'])->name('api.fitness.bmr');
    Route::post('tdee',      [FitnessController::class, 'tdee'])->name('api.fitness.tdee');
    Route::post('body-fat',  [FitnessController::class, 'bodyFat'])->name('api.fitness.bodyfat');
    Route::post('ideal',     [FitnessController::class, 'ideal'])->name('api.fitness.ideal');
    Route::post('macros',    [FitnessController::class, 'macros'])->name('api.fitness.macros');
});




Route::middleware(['auth'])->group(function () {

    Route::get('/lenghts', [LengthController::class, 'index'])->name('api.lenghts.index');


    Route::post('v1/fitness/save',      [FitnessController::class, 'save'])->name('api.fitness.save');
    Route::get('v1/fitness/recent',     [FitnessController::class, 'recent'])->name('api.fitness.recent');
});


Route::post('/lenghtsave', [LengthController::class, 'store'])
    ->name('lenghtsave');





Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');
