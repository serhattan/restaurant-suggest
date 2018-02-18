<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
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
        if (Session::has('language') && in_array(Session::get('language'), config('app.available_locales'))) {
            App::setLocale(Session::get('language'));
        }

        return $next($request);
    }
}
