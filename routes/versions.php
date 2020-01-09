<?php

//$helperModel = '\App\Classes\\' . session()->get('version') . '\Helper';
//$domain = $helperModel::getAppDomain();
$domain = App\Classes\Helper::getAppDomain();
$versionController = app()->make(\App\Http\Controllers\VersionController::class);
$vcController = app()->make(\App\Http\Controllers\VersionCompanyController::class);

Route::group(['domain' => '{company}.' . $domain, 'middleware' => ['auth']], function() use($versionController, $vcController) 
{
    /*
     * ================================================
     * Versions
     * ================================================
     */
    Route::get('versions', function($company) use($versionController) 
    {
        //dd('route.versions'); 
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('index', $parameters = []);
    })->name('versions');

    Route::get('versions.show/{id}', function($company, $id) use($versionController) 
    {
        //dd('route.versions.show', $company, $id); 
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('show', $parameters = ['id' => $id]);
    })->name('versions.show');

    Route::get('versions.create', function() use($versionController) 
    {
        //dd('route.versions.create'); 
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('create', $parameters = []);
    })->name('versions.create');

    Route::get('versions.edit/{id}', function($company, $id) use($versionController) 
    {
        //dd('versions.edit', $id);
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('edit', $parameters = ['id' => $id]);
    })->name('versions.edit');

    Route::post('versions.store', function() use($versionController) 
    {
        //dd('route.versions.store'); 
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('store', $parameters = ['request' => request()]);
    })->name('versions.store');

    Route::put('versions.update/{id}', function($company, $id) use($versionController) 
    {
        //dd('versions.update', request(), $id); 
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('update', $parameters = [
            'request' => request(), 
            'id' => $id
        ]);
    })->name('versions.update');

    Route::delete('versions.destroy/{id}', function($company, $id) use($versionController) 
    {
        //dd('versions.destroy', $id);
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('destroy', $parameters = ['id' => $id]);
    })->name('versions.destroy');

    Route::post('versions.restore/{id}', function($company, $id) use($versionController) 
    {
        //dd('versions.restore', $id);
        //$controller = app()->make(App\Http\Controllers\VersionController::class);
        return $versionController->callAction('restore', $parameters = ['id' => $id]);
    })->name('versions.restore');
    // ================================================

    /*
     * ================================================
     * Version Company Connection
     * ================================================
     */
    Route::get('version_company', function() use($vcController) 
    {
        //dd('version_company');
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('index', $parameters = []);
    })->name('version_company');

    Route::get('version_company.show/{id}', function($company, $id) use($vcController) 
    {
        //dd('version_company.show', $id);
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('show', $parameters = ['id' => $id]);
    })->name('version_company.show');

    Route::get('version_company.create', function() use($vcController) 
    {
        //dd('version_company.create');
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('create', $parameters = []);
    })->name('version_company.create');

    Route::get('version_company.edit/{id}', function($company, $id) use($vcController) 
    {
        //dd('version_company.edit', $id);
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('edit', $parameters = ['id' => $id]);
    })->name('version_company.edit');

    Route::post('versions_company.store', function() use($vcController) 
    {
        //dd('versions_company.store');
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('store', $parameters = ['request' => request()]);
    })->name('versions_company.store');

    Route::put('version_company.update/{id}', function($company, $id) use($vcController) 
    {
        //dd('version_company.update', $id);
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('update', $parameters = [
            'request' => request(), 'id' => $id
        ]);
    })->name('version_company.update');

    Route::delete('version_company.destroy/{id}', function($company, $id) use($vcController) 
    {
        //dd('version_company.destroy', $id);
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('destroy', $parameters = ['id' => $id]);
    })->name('version_company.destroy');

    Route::post('version_company.restore/{id}', function($company, $id) use($vcController) 
    {
        //dd('version_company.restore', $id);
        //$controller = app()->make(App\Http\Controllers\VersionCompanyController::class);
        return $vcController->callAction('restore', $parameters = ['id' => $id]);
    })->name('version_company.restore');
// ================================================
});
