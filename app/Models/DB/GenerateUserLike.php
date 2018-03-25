<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class GenerateUserLike extends Model
{
    protected $table = 'generate_user_like';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo('App\Models\DB\User', 'user_id', 'id');
    }

    public function generate()
    {
        return $this->belongsTo('App\Models\DB\Generate', 'generate_id', 'id');
    }
}
