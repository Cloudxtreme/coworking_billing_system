<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	protected $fillable = [
		'stripe_id','name','description','amount','custom','image'
	];

	public function plan()
	{
		$this->belongsTo('App\User');
	}
}