<?php

//$helperModel = '\App\Classes\\' . session()->get('version') . '\Helper';
//$domain = $helperModel::getAppDomain();
$domain = App\Classes\Helper::getAppDomain();

Route::group(['domain' => '{company}.' . $domain, 'middleware' => ['auth']], function()
{
    Route::get('roles', function()
    {
        //dd('route.roles');
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('index', $parameters = ['request' => request()]);
    })->name('roles');

    Route::get('roles.search', function($company)
    {
        dd('route.roles.search');
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('search', $parameters = ['request' => request()]);
    })->name('roles.search');

    Route::get('roles.show/{id}', function($company, $id)
    {
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('show', $parameters = ['id' => $id]);
    })->name('roles.show');

    Route::get('roles.create', function()
    {
        //dd('routes.roles.create');
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('create', []);
    })->name('roles.create');

    Route::get('roles.edit/{id}', function($company, $id)
    {
        //dd('roles.edit', $id);
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('edit', ['id' => $id]);
    })->name('roles.edit');

    Route::post('roles.store', function()
    {
        //dd('roles.store', request());
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('roles.store');

    Route::put('roles.update/{id}', function($company, $id)
    {
        //dd('roles.update', $id);
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('update', $parameters = ['request' => request(), 'id' => $id]);
    })->name('roles.update');

    Route::delete('roles.destroy', function($company, $id)
    {
        dd('roles.destroy');
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('destroy', $parameters = ['id' => $id]);
    })->name('roles.destroy');

    Route::get('roles.restore/{id}', function($company, $id)
    {
        dd('roles.restore');
        $controller = app()->make(App\Http\Controllers\RoleController::class);
        return $controller->callAction('restore', $parameters = ['id' => $id]);
    })->name('roles.restore');
});
