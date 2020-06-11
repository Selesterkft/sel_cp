<?php

$domain = App\Classes\Helper::getAppDomain();
$controller = app()->make(App\Http\Controllers\PermissionsController::class);

Route::group(['domain' => '{company}.' . $domain, 'middleware' => ['auth', 'HtmlMinifier']], function() use($controller)
{
    Route::get('permissions', function() use($controller)
    {
        return $controller->callAction('index', $parameters = ['request' => request()]);
    })->name('permissions');

    Route::get('permissions.create', function() use($controller)
    {
        return $controller->callAction('create', $parameters = []);
    })->name('permissions.create');

    Route::post('permissions.store', function() use($controller)
    {
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('permissions.store');

    Route::get('permissions.edit/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('edit', $parameters = ['id' => $id]);
    })->name('permissions.edit');

    Route::put('permissions.update/{id}', function($id) use($controller)
    {
        return $controller->callAction('update', $parameters = ['request' => request(), 'id' => $id]);
    })->name('permissions.update');

    Route::delete('permissions.delete/{id}', function($id) use($controller)
    {
        return $controller->callAction('delete', $parameters = ['id' => $id]);
    })->name('permissions.delete');

    Route::get('permissions.restore/{id}', function($id) use($controller)
    {
        return $controller->callAction('restore', $parameters = ['id' => $id]);
    })->name('permissions.restore');
});
