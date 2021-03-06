<?php

$domain = App\Classes\Helper::getAppDomain();
$controller = app()->make(\App\Http\Controllers\CompanySubdomainController::class);

Route::group(['domain' => '{company}.' . $domain, 'middleware' => ['auth', 'HtmlMinifier']], function() use($controller)
{
    // Index
    Route::get('companysubdomain', function($company) use($controller)
    {
        return $controller->callAction('index', $parameters = []);
    })->name('companysubdomain');

    // Show
    Route::get('companysubdomain.show/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('show', $parameters = ['id' => $id]);
    })->name('companysubdomain.show');

    // Create
    Route::get('companysubdomain.create', function() use($controller)
    {
        return $controller->callAction('create', $parameters = []);
    })->name('companysubdomain.create');

    // Edit
    Route::get('companysubdomain.edit/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('edit', $parameters = ['id' => $id]);
    })->name('companysubdomain.edit');

    // Store
    Route::post('companysubdomain.store', function() use($controller)
    {
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('companysubdomain.store');

    // update
    Route::put('companysubdomain.update/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('update', $parameters = [
            'request' => request(),
            'id' => $id
        ]);
    })->name('companysubdomain.update');

    // Delete
    Route::delete('companysubdomain.destroy/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('destroy', $parameters = ['id' => $id]);
    })->name('companysubdomain.destroy');

    Route::post('companysubdomain.restore/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('restore', $parameters = ['id' => $id]);
    })->name('companysubdomain.restore');
});
