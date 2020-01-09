<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Session::has('appLocale') )
        {
            App::setLocale(Session::get('appLocale'));
        }
        else
        {
            Session::put('appLocale', Config::get('app.locale'));
            App::setLocale(Config::get('app.locale'));
        }

        App::setLocale( Session::has('appLocale') ? Session::get('appLocale') : Config::get('app.locale') );

        return $next($request);
    }
}
