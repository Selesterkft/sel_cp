<?php

$domain = App\Classes\Helper::getAppDomain();

$controller = app()->make(App\Http\Controllers\PageSettingsController::class);

Route::group( [ 'domain' => '{company}.' . $domain, 'middleware' => ['auth', 'HtmlMinifier'] ], function() use($controller)
{
    // index
    Route::get('page_settings', function($company) use($controller){
        return $controller->callAction('index', $parameters = []);
    })->name('page_settings');
    /*
    // show
    Route::get('page_settings.show/{id}', function($company, $id) use($controller){
        return $controller->callAction('show', $parameters = ['id' => $id]);
    })->name('page_settings.show');

    // create
    Route::get('page_settings.create', function() use($controller){
        return $controller->callAction('create', $parameters = []);
    })->name('page_settings.create');

    // store
    Route::post('page_settings.store', function($company) use($controller){
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('page_settings.edit');

    // edit
    Route::get('page_settings.edit/{id}', function($company, $id) use($controller){
        return $controller->callAction('edit', $parameters = ['id' => $id]);
    })->name('page_settings.edit');

    // update
    Route::put('page_settings.update', function($company, $id) use($controller){
        return $controller->callAction('update', $parameters = ['request' => request(), 'id' => $id]);
    })->name('page_settings.edit');

    // destroy
    Route::delete('page_settings.destroy/{id}', function($company, $id) use($controller){
        return $controller->callAction('destroy', $parameters = ['id' => $id]);
    })->name('page_settings.destroy');

    // restore
    Route::post('page_settings.restore/{id}', function($company, $id) use($controller){
        return $controller->callAction('restore', $parameters = ['id' => $id]);
    })->name('page_settings.restore');
    */
} );
