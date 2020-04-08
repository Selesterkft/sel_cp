<?php
$domain = App\Classes\Helper::getAppDomain();

Route::group([ 'domain' => '{company}.' . $domain, 'middleware' => ['auth'] ], function()
{
    Route::get('stocks', function($company)
    {
        $controller = app()->make('App\Http\Controllers\\' . session()->get('version') . '\StocksController');
        return $controller->callAction('index', $parameters = [
            'request' => request()
        ]);
    })->name('stocks');
});
