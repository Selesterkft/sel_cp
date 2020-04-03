<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('translations/{language}/edit', 'TranslationsCotroller@editTranslate');
Route::post('settings/design/edit', 'SettingsController@designUpdate');

/* Versions */
Route::get(
    'getVersions',
    'VersionController@getVersions')
    ->name('getVersions');
Route::post('storeVersion', 'VersionController@storeVersion')->name('storeVersion');
Route::put('updateVersion/{id}', function($id){
    $controller = app()->make(App\Http\Controllers\VersionController::class);

    return $controller->callAction('updateVersion', $parameters = [
        'request' => request(), 'id' => $id]);
})->name('updateVersion');

Route::get('getVersionsToSelect', 'VersionController@getVersionsToSelect')
    ->name('getVersionsToSelect');
/*===================================*/

Route::get('getPartnersToSelect/{client_id}/{version}', function($client_id, $version)
{
    return App\Classes\Helper::getPartners($client_id, $version);
})->name('getPartnersToSelect');

/*
Route::get('getAllCompanyToSelect', 'CompaniesController@getAllCompanyToSelect')
    ->name('getAllCompanyToSelect');
*/
/*
Route::get('getAllCompanyToSelect', function()
{
    $controller = app()->make('App\Http\Controllers\\' . session()->get('version') . '\CompanyController');
    dd('route.getCompanyToSelect', $controller);
    return $controller->callAction('getAllCompanyToSelect', $parameters = []);
})->name('getCompanyToSelect');
*/
/*===================================*/

/* == CompanyVesions == */
Route::get(
    'getCompaniesVersions',
    'VersionCompanyController@getCompanyVersions')
    ->name('getCompaniesVersions');

Route::post('storeCompanyVersion', 'VersionCompanyController@storeCompanyVersion')
    ->name('storeCompanyVersion');

Route::put('updateCompanyVersion/{id}', function($id){
    $controller = app()->make(App\Http\Controllers\VersionCompanyController::class);

    return $controller->callAction('updateCompanyVersion', $parameters = [
        'request' => request(), 'id' => $id]);
})->name('updateCompanyVersion');
/*===================================*/
