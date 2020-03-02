<?php

//$helperModel = '\App\Classes\\' . session()->get('version') . '\Helper';
//$domain = $helperModel::getAppDomain();
$domain = App\Classes\Helper::getAppDomain();

// ============================================
// Minden partner Users index routja
// ============================================
Route::group([ 'domain' => '{company}.' . $domain, 'middleware' => ['auth'] ], function()
{
    Route::get('users2', function($company)
    {
        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\Users2Controller');
        return $controller->callAction('index', $parameters = ['request' => request()]);
    })->name('users2');

    Route::get('users', function($company){

        //dd('routes.users:12', session()->get('version'), session()->all());

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\UsersController');
        return $controller->callAction('index', $parameters = []);

    })->name('users');

    Route::get('users.search', function()
    {
        //dd('route.users.search');

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\UsersController');
        return $controller->callAction('search', $parameters = ['request' => request()]);

    })->name('users.search');

    // Ide kell a $company változó!! NE TÖRÖLD KI
    Route::get('users.show/{id}', function($company, $id)
    {
        //dd('route.users.show', $id);

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\UsersController');
        return $controller->callAction('show', $parameters = ['id' => $id]);

    })->name('users.show');

    Route::get('users.create', function()
    {
        //dd('route.users.create');

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\UsersController');
        return $controller->callAction('create', $parameters = []);

    })->name('users.create');

    // Ide kell a $company változó!! NE TÖRÖLD KI
    Route::get('users.edit/{id}', function($company, $id)
    {
        //dd('route.users.edit');

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\UsersController');
        return $controller->callAction('edit', $parameters = ['id' => $id]);

    })->name('users.edit');

    Route::post('users.store', function()
    {
        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\UsersController');
        return $controller->callAction('store', $parameters = ['request' => request()]);
    })->name('users.store');

    Route::put('users.update/{id}', function($company, $id)
    {
        //dd('route.users.update');

        $controller = app()->make('\App\Http\Controllers\\' . session()->get('version') . '\UsersController');
        return $controller->callAction('update', $parameters = ['request' => request(), 'id' => $id]);

    })->name('users.update');

    Route::delete('users.destroy/{id}', function($id)
    {
        dd('route.users.destroy');
        /*
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\UsersController');
        return $controller->callAction('destroy', $parameters = ['id' => $id]);
        */
    })->name('users.destroy');

    Route::post('users.restore/{id}', function($id)
    {
        dd('route.users.restore');
        /*
        $controller = app()->make('\App\Http\Controllers\\' . $version . '\UsersController');
        return $controller->callAction('restore', $parameters = ['id' => $id]);
        */
    })->name('users.restore');

    Route::get('profile/{id}', function($id)
    {
        dd('route.users.profile');
        //$controller = app()->make('\App\Http\Controllers\\' . $version . '\ProfileController');
        //return $controller->callAction('index', $parameters = ['id' => $id]);

    })->name('profile');

    Route::put('profile.update/{id}', function($id)
    {
        dd('route.users:89', $id);
        //$controller = app()->make('\App\Http\Controllers\\' . $version . '\ProfileController');
        //return $controller->callAction('update', $parameters = ['request' => request(), 'id' => $id]);

    })->name('profile.update');

});
// ============================================
