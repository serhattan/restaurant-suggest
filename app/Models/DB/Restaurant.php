<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurant';
    public $incrementing = false;

    public function group()
    {
        return $this->hasOne('App\Models\DB\Group', 'id', 'group_id');
    }
}
