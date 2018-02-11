<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    public $incrementing = false;

    public function createdBy()
    {
        return $this->belongsTo('App\Models\DB\User', 'user_id', 'id');
    }
}
