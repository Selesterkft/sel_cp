<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Localization
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
        if(session()->has('locale'))
        {
            \App::setLocale(session()->get('locale'));
        }
        else
        {
            $user = Auth::user();

            if( !isset($user) )
            {
                \App::setLocale(config('app.locale'));
            }
            else
            {
                \App::setLocale($user->language);
            }
        }

        return $next($request);
    }
}
