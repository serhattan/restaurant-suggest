<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    public $incrementing = false;

    public function createdBy()
    {
        return $this->belongsTo('App\Models\DB\User', 'created_by', 'id');
    }

    public function groupUsers()
    {
        return $this->hasMany('App\Models\DB\GroupUser', 'group_id', 'id');
    }
}
