<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    public function user()
    {
    	$this->belongsTo('App\User');
    }
}
