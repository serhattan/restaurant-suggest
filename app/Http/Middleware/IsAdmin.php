<?php

namespace App\Http\Middleware;

use App\Models\Entity\Group;
use App\Models\GroupManager;
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
        $group = GroupManager::get($groupId);
        if ($group instanceof Group && !$group->getIsAdmin()) {
            throw new Exception(__('messages.access_denied'));
        }
        return $next($request);
    }
}
