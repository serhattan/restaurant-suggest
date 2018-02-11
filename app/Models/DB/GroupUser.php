<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_user';
    public $incrementing = false;

    public function group()
    {
        return $this->belongsTo('App\Models\DB\Group', 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\DB\User', 'user_id', 'id');
    }
}
