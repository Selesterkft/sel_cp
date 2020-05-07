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

    Route::get('wrhs_stocks', function($company)
    {
        $controller = app()->make('App\Http\Controllers\\' . session()->get('version') . '\WrhsStocksController');
        return $controller->callAction('index', $parameters = ['request' => request()]);
    })->name('wrhs_stocks');

    /*
    Route::get('table_teszt', function($company)
    {
        $controller = app()->make(\App\Http\Controllers\TableTesztController::class);
        return $controller->callAction('index', $parameters = ['request' => request()]);
    })->name('table_teszt');
    */

    Route::get('cfg_db/{table}', function($company, $table)
    {
        return \App\Classes\WrhsHelper::cfg_db($table);
    });

    Route::get('sess_tbl/{table}', function($company, $table)
    {
        return \App\Classes\WrhsHelper::sess_tbl($table);
    });

    Route::get('sess_db/{table}', function($company, $table)
    {
        return \App\Classes\WrhsHelper::sess_db($table);
    });

    Route::get('db_tbl/{table}', function($company, $table)
    {
        return \App\Classes\WrhsHelper::db_tbl($table);
    });
});
