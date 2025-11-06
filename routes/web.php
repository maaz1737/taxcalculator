<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConvertController;
use App\Http\Controllers\FavoriteCalculatorsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LengthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\V1\FinanceController as F;
use App\Http\Controllers\V1\FitnessController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\SimpleCalculatorController;
use App\Http\Controllers\StripeController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');



// In routes/web.php

// 1. Verification Notice (Controller constructor handles 'auth')
Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'signedVerify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// 3. Resend Action
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['throttle:6,1'])
    ->name('verification.send');



Route::post('/register', [UserController::class, 'registerPost'])->name('registerPost');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');



Route::view('/length', 'length.index')->name('length');
Route::view('/area', 'area.area')->name('area');
Route::view('/weight', 'weight.weight')->name('weight');
Route::view('/temperature', 'temperature.temperature')->name('temperature');
Route::view('/time', 'time.time')->name('time');
Route::view('/volume', 'volume.volume')->name('volume');
Route::view('/mortgage', 'finance/mortgage')->name('finance.mortgage');
Route::view('/auto', 'finance/auto')->name('page.auto');
Route::view('/loan', 'finance/loan')->name('page.loan');
Route::view('/tax/calculation/calculator', 'finance/income-tax')->name('finance.tax');
Route::view('/depreciation', 'finance/depreciation')->name('finance.depreciation');
Route::view('/rent/calculation/calculator', 'finance.rent')->name('finance.rent');
Route::view('/income-tax', 'finance.income-tax')->name('finance.income_tax');


Route::view('/salary/calculation/calculator', 'finance.salary')->name('finance.salary');
Route::prefix('fitness')->group(function () {
    Route::get('/bmi-calculator', [FitnessController::class, 'bmi_view'])->name('fitness.bmi');
    Route::get('/bmr-calculator', [FitnessController::class, 'bmr_view'])->name('fitness.bmr');
    Route::get('/tdee-calculator', [FitnessController::class, 'tdee_view'])->name('fitness.tdee');
    Route::get('/body-fat-calculator', [FitnessController::class, 'body_fat_view'])->name('fitness.bodyfat');
    Route::get('/ideal-weight-calculator', [FitnessController::class, 'ideal_weight_view'])->name('fitness.ideal');
    Route::get('/macros-calculator', [FitnessController::class, 'macros_view'])->name('fitness.macros');
});


Route::post('/v1/calculations/recent', [FitnessController::class, 'recent']);


Route::view('/scientific/calculator', 'scientificcalculator')->name('scientificcalculator');
Route::get('/convert', [ConvertController::class, 'convert'])->name('api.convert');
Route::get('/convert/table', [ConvertController::class, 'table'])->name('api.convert.table');








Route::prefix('v1/finance')->as('v1.finance.')->group(function () {
    Route::post('mortgage',      [F::class, 'mortgage'])->name('mortgage');
    Route::post('mortgagesave',      [F::class, 'mortgage_save'])->middleware(['auth', 'verified'])->name('mortgagesave');
    Route::post('mortgageHistory',      [F::class, 'mortgageHistory'])->middleware(['auth', 'verified'])->name('mortgageHistory');
    // Route::post('auto',          [F::class, 'auto'])->name('auto');                    
    // Route::post('loan',          [F::class, 'loan'])->name('loan');                     
    Route::post('rent',          [F::class, 'rent'])->name('rent');
    Route::post('/rentsave',          [F::class, 'rent_save'])->middleware(['auth', 'verified'])->name('rent_save');
    Route::post('/income-tax', [F::class, 'tax'])->middleware(['auth', 'verified'])->name('api.finance.income_tax');
    Route::post('/salary', [F::class, 'salary'])->name('api.finance.salary');
    Route::post('/salarysave', [F::class, 'save_salary'])->middleware(['auth', 'verified'])->name('api.finance.save_salary');
    Route::get('/salaryhistory', [F::class, 'salaryhistory'])->middleware(['auth', 'verified'])->name('api.finance.salaryhistory');
    Route::post('depreciation',  [F::class, 'depreciation'])->name('depreciation');
    Route::post('depreciationsave',  [F::class, 'depreciationSave'])->middleware(['auth', 'verified'])->name('depreciationSave');
    Route::get('/DepreciationHistory',  [F::class, 'DepreciationHistory'])->middleware(['auth', 'verified'])->name('DepreciationHistory');
});



// fixed routes with all problem solved 

Route::get('/rent/calculation/calculator/rentHistory', [F::class, 'rentHistory'])->middleware(['auth', 'verified'])->name('rentHistory');

Route::get('/gettax', [F::class, 'getTax'])->middleware(['auth', 'verified']);


Route::prefix('v1/fitness')->as('v1.fitness.')->group(function () {
    Route::post('bmi',       [FitnessController::class, 'bmi'])->name('api.fitness.bmi');
    Route::post('bmr',       [FitnessController::class, 'bmr'])->name('api.fitness.bmr');
    Route::post('tdee',      [FitnessController::class, 'tdee'])->name('api.fitness.tdee');
    Route::post('body-fat',  [FitnessController::class, 'bodyFat'])->name('api.fitness.bodyfat');
    Route::post('ideal',     [FitnessController::class, 'ideal'])->name('api.fitness.ideal');
    Route::post('macros',    [FitnessController::class, 'macros'])->name('api.fitness.macros');
});




Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lenghts', [LengthController::class, 'index'])->name('api.lenghts.index');
    Route::post('v1/fitness/save',      [FitnessController::class, 'save'])->name('api.fitness.save');
    Route::get('v1/fitness/recent',     [FitnessController::class, 'recent'])->name('api.fitness.recent');



    //scientific calculator routes
    Route::post('/save/history', [SimpleCalculatorController::class, 'store'])->name('save.scientific.history');
    Route::get('/get/history', [SimpleCalculatorController::class, 'index'])->name('get.scientific.history');
    Route::post('/delete/history', [SimpleCalculatorController::class, 'destory'])->name('delete.scientific.history');
});
Route::post('/lenghtsave', [LengthController::class, 'store'])->middleware(['auth', 'verified'])
    ->name('lenghtsave');


Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');
Route::get('tax/finance', [CategoryController::class, 'TaxFinance'])->name('tax.finance');
Route::get('math/measurement', [CategoryController::class, 'MathMeasurement'])->name('math.measurement');
Route::get('health/fitness', [CategoryController::class, 'HealthFitness'])->name('health.fitness');
Route::get('/favorites/calculators', [FavoriteCalculatorsController::class, 'index'])->name('favorites.calculators');
Route::post('/favorites/calculators/store', [FavoriteCalculatorsController::class, 'store'])->name('favorites.calculators.store');
Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession']);
Route::get('/success', [StripeController::class, 'success']);
Route::get('/cancel', [StripeController::class, 'cancel']);



// point of interest routes

Route::get('/age/calculator', function () {
    return view('age.age_calculator');
})->name('avg.calculator');

Route::post('/age/calculator', [App\Http\Controllers\AgeController::class, 'calculate'])->name('age.calculate');