<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GroupUserManager;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $groupId)
    {
        if (!GroupUserManager::adminCheck($groupId)) {
            throw new UserException(@lang('messages.ACCESS_DENIED'));
        }

        return $next($request);
    }
}
