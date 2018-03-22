<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GroupUserManager;
use Mockery\Exception;

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
            throw new Exception(__('messages.ACCESS_DENIED'));
        }

        return $next($request);
    }
}
