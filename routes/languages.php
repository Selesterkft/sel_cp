<?php
$domain = App\Classes\Helper::getAppDomain();
$controller = app()->make(App\Http\Controllers\LanguagesCotroller::class);

Route::group(['domain' => '{company}.' . $domain, 'middleware' => ['auth']], function() use ($controller)
{
    // Languages
    // index
    Route::get('languages', function() use($controller)
    {
        return $controller->callAction('index', $parameters = []);
    })->name('languages');

    // create
    Route::get('languages/create', function($company) use($controller)
    {
        return $controller->callAction('create', $parameters = []);
    })->name('languages.create');

    // store
    Route::post('languages', function($company) use($controller)
    {
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('languages');
    // show
    Route::get('languages/{id}', function($id) use($controller)
    {
        return $controller->callAction('show', $parameters = ['id' => $id]);
    })->name('languages.show');
    // edit
    Route::get('languages/{id}/edit', function($id) use ($controller)
    {
        return $controller->callAction('edit', $parameters = ['id' => $id,]);
    })->name('languages.edit');
    // update
    Route::put('languages/{id}', function($id) use($controller)
    {
        return $controller->callAction('update', $parameters = ['request' => request(), 'id' => $id]);
    })->name('languages.update');
    // delete
    Route::delete('languages/destroy/{id}', function($id) use($controller)
    {
        return $controller->callAction('', $parameters = ['id' => $id]);
    })->name('languages.destroy');
});
