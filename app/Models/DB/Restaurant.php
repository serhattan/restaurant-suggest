<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurant';
    public $incrementing = false;

    public function group()
    {
        return $this->hasOne('App\Models\DB\Group', 'group_id', 'id');
    }
}
