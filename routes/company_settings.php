<?php

$domain = App\Classes\Helper::getAppDomain();

$controller = app()->make(App\Http\Controllers\CompanySettingsController::class);

Route::group( [ 'domain' => '{company}.' . $domain, 'middleware' => ['auth'] ], function() use($controller)
{
    // index
    Route::get('company_settings', function ($company) use ($controller) {
        return $controller->callAction('index', $parameters = []);
    })->name('company_settings');

    Route::get('get_company-version', function($company) use($controller)
    {
        //dd('route get_company_version');
        return $controller->callAction('getCompanyVersion', $parameters = [
            'request' => request()
        ]);
    })->name('get_company-version');

    // store
    Route::post('company_settings.store', function($company) use($controller)
    {
        dd('route.company_settings.store', request());
        return $controller->callAction('storeCompanyVersion', $parameters = ['request' => request()]);
    })->name('company_settings.edit');

    /*
    // show
    Route::get('company_settings.show/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('show', $parameters = ['id' => $id]);
    })->name('company_settings.show');

    // create
    Route::get('company_settings.create', function() use($controller)
    {
        return $controller->callAction('create', $parameters = []);
    })->name('company_settings.create');

    // edit
    Route::get('company_settings.edit/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('edit', $parameters = ['id' => $id]);
    })->name('company_settings.edit');



    // update
    Route::put('company_settings.update', function($company, $id) use($controller)
    {
        return $controller->callAction('update', $parameters = ['request' => request(), 'id' => $id]);
    })->name('company_settings.edit');

    // destroy
    Route::delete('company_settings.destroy/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('destroy', $parameters = ['id' => $id]);
    })->name('company_settings.destroy');

    // restore
    Route::post('company_settings.restore/{id}', function($company, $id) use($controller)
    {
        return $controller->callAction('restore', $parameters = ['id' => $id]);
    })->name('company_settings.restore');*/
}
);
