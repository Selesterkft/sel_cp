<?php

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

Route::get('inv.data', function()
{
    $controller = app()->make('App\Http\Controllers\\' . session()->get('version') . '\InvController');
    return $controller->callAction('index', $parameters = ['request' => request()]);
});

//Route::get('/home', function(){ dd('HOME'); });
Route::redirect('/home', '/');

/*
Route::get('/', function () {
    return view('welcome');
});
*/
//Auth::routes();

// Token frissítés
/*
Route::get('refresh-csrf', function(){
    return csrf_token();
});
*/
// route to show the login form
Route::get('login', ['uses' => '\App\Http\Controllers\Auth\MyLoginController@showLogin'])->name('login');
// route to process the form
Route::post('login', ['uses' => '\App\Http\Controllers\Auth\MyLoginController@doLogin'])->name('login');
//Route::post('logout', ['uses' => '\App\Http\Controllers\Auth\MyLoginController@doLogout'])->name('logout');
Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

/*
 * ================================================
 * Home
 * ================================================
 */
Route::get('/', 'HomeController@index')->name('home');
// ================================================

/*
 * ================================================
 * Language change
 * ================================================
 */
Route::get('lang/{locale}', 'LocalizationController@index');
// ================================================

$domain = App\Classes\Helper::getAppDomain();

//$helperModel = '\App\Classes\\' . session()->get('version') . '\Helper';
//dd('route.web', Illuminate\Support\Facades\Session::all(), $helperModel);
//$domain = $helperModel::getAppDomain();

Route::group([ 'domain' => '{company}.' . $domain, 'middleware' => ['auth', 'HtmlMinifier'] ], function()
{
    // Szerepkörök
    //Route::resource('roles', 'RoleController');
    /*
    // Beállítások
    Route::resource('settings', 'SettingsController');

    // Image Upload
    Route::get('image/upload', 'ImageUploadController@fileCreate');

    //Route::post('image_upload', 'SettingsController@fileStore')->name('image_upload');
    Route::post('image_upload', 'SettingsController@fileStore')->name('image_upload');

    Route::post('image_upload.delete', 'SettingsController@fileDestroy')
        ->name('image_upload.delete');
    */
    // Subdomain Helper
    Route::resource('sd_helper', 'SdHelperController');
    /*
    Route::get('sd_helper', function()
    {
        //dd('routes.web.sd_helper');
        $controller = app()->make(App\Http\Controllers\SdHelperController::class);
        return $controller->callAction('index', $parameters = []);

    })->name('sd_helper');
    */
});

Route::get('/clear-cache', function() {

    try
    {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    }
    catch(\Exception $e)
    {
        dd($e);
    }
});

Route::get('/clear-view', function(){
    Artisan::call('view:clear');
    return 'View is cleared';
});

Route::get('/clear-config', function(){
    Artisan::call('config:clear');
    return 'Config is cleared';
});

// =========================================
// Okosságok
// forrás: https://laraveldaily.com/9-things-you-can-customize-in-laravel-registration/
// =========================================

/*
Auth::routes([
    // Regisztráció letiltása / Engedélyezése
    'register' => false,
    // E-mail ellenőrzés letiltása / Engedélyezése
    'verify' => false,
    // Jelszó visszaállítás letiltása / Engedélyezése
    'reset' => false,
]);
*/

// ---------------------------
// Átirányítás regisztráció után
// ---------------------------
// Alapértelmezés szerint az új regisztrált felhasználókat átirányítják az URL/home címre.
// Ha ezt meg akarja változtatni megteheti ebben a fájlban:
// app/Http/Controllers/Auth/RegisterController.php

// ---------------------------
// Validációs szabályok megváltoztatása
// ---------------------------
// Ellenőrzés helye:
// app/Http/Controllers/Auth/RegisterController.php

// ---------------------------
// További mezők hozzáadása a regisztrációs űrlaphoz
// ---------------------------
// Pl.: Vezetéknév hozzáadása:
// 1. Add hozzá a mezőt az adatbázithoz:
//      Addja hozzá ezt a sort a migrációs fájlhoz:
//          $table->string('vezetéknév', 255);
// 2. Add hozzá a mezőt a modellhez:
//          protected $fillable = [
//              'name', 'email', 'password', 'vezeteknev'
//          ];
// 3. Add hozzá az űrlaphoz:
//      resources/views/auth/register.blade.php
//<div class="form-group row">
//    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
//
//    <div class="col-md-6">
//        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
//
//@if ($errors->has('name'))
//            <span class="invalid-feedback" role="alert">
//                <strong>{{ $errors->first('name') }}</strong>
//            </span>
//@endif
//    </div>
//</div>
// 4. Módosítsd a create() metódust:
//      RegisterController
//          protected function create(array $data)
//          {
//              return User::create([
//                  'name' => $data['name'],
//                  'surname' => $data['surname'],
//                  'email' => $data['email'],
//                  'password' => Hash::make($data['password']),
//              ]);
//          }
