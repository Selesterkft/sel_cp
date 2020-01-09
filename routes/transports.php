<?php

//$helperModel = '\App\Classes\\' . session()->get('version') . '\Helper';
//$domain = $helperModel::getAppDomain();
$domain = App\Classes\Helper::getAppDomain();

// ============================================
// Minden partner Transports rout-ok
// ============================================
Route::group([ 'domain' => '{company}.' . $domain, 'middleware' => ['auth'] ], function()
{
    Route::get('transports', function()
    {
        dd('route.transports:12');
        /*
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('index', $parameters = [
            'version' => $version,
        ]);
        */
    })->name('transports');

    Route::get('transports.search/{version}', function($version)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('search', $parameters = ['request' => request()]);
    })->name('transports.search');

    Route::get('transports.show/{version}/{id}', function($version, $id)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('show', $parameters = ['id' => $id]);
    })->name('transports.show');

    Route::get('transports.create/{version}', function($version)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('create', $parameters = [
            'version' => $version,
        ]);
    })->name('transports.create');

    Route::post('transports.store/{version}', function($version)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('transports.store');

    Route::get('transports.edit/{version}/{id}', function($version, $id)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('edit', $parameters = ['id' => $id]);
    })->name('transports.edit');

    Route::put('transports.update/{version}', function($version)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('update', $parameters = ['request' => request()]);
    })->name('transports.update');

    Route::delete('transports.destroy/{version}/{id}', function($version, $id)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('destroy', $parameters = ['id' => $id]);
    })->name('transports.destroy');

    Route::post('transports.restore/{version}/{id}', function($version, $id)
    {
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\TransportsController');
        return $controller->callAction('restore', $parameters = ['id' => $id]);
    })->name('transports.restore');
});