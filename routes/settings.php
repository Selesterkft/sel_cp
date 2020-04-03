<?php

$domain = App\Classes\Helper::getAppDomain();

$controller = app()->make(App\Http\Controllers\SettingsController::class);

Route::group( [ 'domain' => '{company}.' . $domain, 'middleware' => ['auth'] ], function() use($controller)
{
    Route::get('settings', function($company) use($controller)
    {
        return $controller->callAction('index', $parameters = []);
    })->name('settings');

    // GENERAL settings
    Route::put('settings.saveGeneral', function($company) use($controller)
    {
        return $controller->callAction('saveGeneral', $parameters = [
            'request' => request()
        ]);
    })->name('settings.saveGeneral');
    Route::get('settings.restoreGeneral', function($company) use($controller)
    {
        return $controller->callAction('restoreGeneral', $parameters = []);
    })->name('settings.restoreGeneral');
    // ============================

    // LOGIN Settings
    Route::put('settings.saveLogin', function($company) use($controller)
    {
        return $controller->callAction('saveLogin', $parameters = [
            'request' => request()
        ]);
    })->name('settings.saveLogin');
    Route::get('settings.restoreLogin', function($company) use($controller)
    {
        return $controller->callAction('restoreLogin', $parameters = []);
    })->name('settings.restoreLogin');
    // ============================

    // DASHBOARD Settings
    Route::put('settings.saveDashboard', function($company) use($controller)
    {
        return $controller->callAction('saveDashboard', $parameters = [
            'request' => request()
        ]);
    })->name('settings.saveDashboard');
    Route::get('settings.restoreDashboard', function($company) use($controller)
    {
        return $controller->callAction('restoreDashboard', $parameters = []);
    })->name('settings.restoreDashboard');
    // ============================

    // USERS Settings
    Route::put('settings.saveUsers', function($company) use($controller)
    {
        return $controller->callAction('saveUsers', $parameters = [
            'request' => request()
        ]);
    })->name('settings.saveUsers');
    Route::get('settings.restoreUsers', function($company) use($controller)
    {
        return $controller->callAction('restoreUsers', $parameters = []);
    })->name('settings.restoreUsers');
    // ============================

    // INVOICES Settings
    Route::put('settings.saveInvoices', function($company) use($controller)
    {
        return $controller->callAction('saveInvoices', $parameters = [
            'request' => request()
        ]);
    })->name('settings.saveInvoices');
    Route::get('settings.restoreInvoices', function($company) use($controller)
    {
        return $controller->callAction('restoreInvoices', $parameters = []);
    })->name('settings.restoreInvoices');
    // ============================

    /*
    Route::put('settings.LoginWallpaperSave/{id}', function($company, $id) use($controller)
    {
        //dd('route.settings.save', request()->all(), $id);
        return $controller->callAction('saveLoginWallpaper', $parameters = [
            'request' => request(), 'id' => $id
        ]);
    })->name('settings.LoginWallpaperSave');

    Route::post('settings.StoreMedia', function()
    {
        dd('route.StoreMedia');
    })->name('settings.StoreMedia');

    Route::post('settings.FaviconSave/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('saveFavicon', $parameters = [
            'request' => $request, 'id' => $id,
        ]);
    });
    */
});
