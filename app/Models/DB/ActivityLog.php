<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    public function activity()
    {
        return $this->hasMany('App\Models\DB\Activity', 'activity_id', 'id');
    }

    public function group()
    {
        return $this->hasMany('App\Models\DB\Group', 'group_id', 'id');
    }

    public function user()
    {
        return $this->hasMany('App\Models\DB\User', 'user_id', 'id');
    }
}
