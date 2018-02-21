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

    public function restaurantUsers()
    {
        return $this->hasMany('App\Models\DB\RestaurantUser', 'restaurant_id', 'id');
    }
}
