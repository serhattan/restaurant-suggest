<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class RestaurantUser extends Model
{
    protected $table = 'restaurant_user';
    public $incrementing = false;

    public function restaurant()
    {
        return $this->belongsTo('App\Models\DB\Restaurant', 'restaurant_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\DB\User', 'user_id', 'id');
    }
}
