<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_log';
    public $incrementing = false;

    public function activity()
    {
        return $this->hasOne('App\Models\DB\Activity', 'id', 'activity_id');
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
