<?php

$domain = App\Classes\Helper::getAppDomain();
$controller = app()->make(App\Http\Controllers\CompanyDesignController::class);

Route::group( [ 'domain' => '{company}.' . $domain, 'middleware' => ['auth'] ], function() use($controller)
{
    //Route::resource('company_design');

    Route::get('company_design', function($company) use($controller)
    {
        return $controller->callAction('index', $parameter = []);
    })->name('company_design');

    // Create
    Route::get('company_design.create', function() use($controller)
    {
        return $controller->callAction('create', $parameter = []);
    })->name('company_design.create');

    // Edit
    Route::get('company_design.edit/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('edit', $parameters = [
            'id' => $id,
            ]);
    })->name('company_design.edit');

    // Store
    Route::post('company_design.store', function() use($controller)
    {
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('company_design.store');

    // Update
    Route::put('company_design.update/{id}', function($company, $id) use($controller)
    {
        //dd('route:company_design.update');
        return $controller->callAction('update', $parameters = [
            'request' => request(),
            'id' => $id
        ]);
    })->name('company_design.update');

    // Delete
    Route::delete('company_design.destroy/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('destroy', $parameters = ['id' => $id]);
    })->name('company_design.destroy');
});
