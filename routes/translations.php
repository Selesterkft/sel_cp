<?php
$domain = App\Classes\Helper::getAppDomain();
$controller = app()->make(App\Http\Controllers\TranslationsCotroller::class);

Route::group(['domain' => '{company}.' . $domain, 'middleware' => ['auth']], function() use ($controller)
{
    // Languages
    // index
    Route::get('translations/{language}', function($company, $language) use($controller)
    {
        return $controller->callAction('index', $parameters = ['language' => $language]);
    })->name('translations');

    // create
    Route::get('translations/create/{language}', function($company, $language) use($controller)
    {
        return $controller->callAction('create', $parameters = ['language' => $language]);
    })->name('translations.create');

    // store
    Route::post('translations/store/{language}', function($company, $language) use($controller)
    {
        return $controller->callAction('store', $parameters = [
            'request' => request(), 'language' => $language
        ]);
    })->name('translations.store');

    // show
    Route::get('translations/show/{language}', function($language) use($controller)
    {
        return $controller->callAction('show', $parameters = ['language' => $language]);
    })->name('translations.show');

    // edit
    Route::get('translations/{id}/{language}', function($company, $language, $id) use ($controller)
    {
        //dd('route.translations.edit',$company, $language, $id);
        return $controller->callAction('edit', $parameters = ['language' => $language, 'id' => $id,]);
    })->name('translations.edit');

    // update
    Route::put('translations/update/{language}/{id}', function($company, $language, $id) use($controller)
    {
        //dd('route.translations.update', $language, $id);
        return $controller->callAction('update', $parameters = [
            'request' => request(),
            'language' => $language,
            'id' => $id
        ]);
    })->name('translations.update');

    // delete
    Route::delete('translations/destroy/{language}/{id}', function($language, $id) use($controller)
    {
        return $controller->callAction('', $parameters = ['language' => $language, 'id' => $id]);
    })->name('translations.destroy');

    Route::post('translations/import', 'TranslationsCotroller@import');
/*
    Route::post('translations/import', function()use($controller)
    {
        return $controller->callAction('import', $parameters = ['request' => request()]);
    })->name('translations.import');
*/
});

