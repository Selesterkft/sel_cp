<?php

//$helperModel = '\App\Classes\\' . session()->get('version') . '\Helper';
$domain = \App\Classes\Helper::getAppDomain();
//$domain = App\Helper::getAppDomain();


// ============================================
// Minden partner Invoices index routja
// ============================================
Route::group([ 'domain' => '{company}.' . $domain, 'middleware' => ['auth'] ], function()
{
    Route::get('invoices', function()
    {
        //dd('routes.invoices');

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\InvoicesController');

        return $controller->callAction('index', $parameters = [
            'request' => request()
        ]);

    })->name('invoices');

    Route::get('invoices.show/{id}', function($company, $id)
    {
        //dd('route.invoices.show', $company, $id);

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\InvoicesController');
        return $controller->callAction('show', $parameters = [
            'request' => request(),
            'id' => $id
        ]);

    })->name('invoices.show');

    Route::get('invoices.search', function()
    {
        //dd('route.invoices.search');

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\InvoicesController');
        return $controller->callAction('index', $parameters = [
            'request' => request(),
        ]);

    })->name('invoices.search');
});
