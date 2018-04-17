<?php

namespace App\Http\Middleware;

use App\Models\GroupUserManager;
use Closure;
use Mockery\Exception;

class IsAdmin
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
        $groupId = $request->get('id');
        if (!GroupUserManager::adminCheck($groupId, Auth::id())) {
            throw new Exception(__('messages.access_denied'));
        }
        return $next($request);
    }
}
