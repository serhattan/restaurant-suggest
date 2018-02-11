<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Generate extends Model
{
    protected $table = 'generate';
    public $incrementing = false;

    public function group()
    {
        return $this->belongsTo('App\Models\DB\Group', 'group_id', 'id');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\DB\Restaurant', 'restaurant_id', 'id');
    }
}
