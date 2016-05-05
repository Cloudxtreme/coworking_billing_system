<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{

    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bio()
    {
        $this->hasOne('App\Bio');
    }

    public function addBio(Bio $bio)
    {
        return $this->bios()->save($bio);
    }

    public function plan()
    {
        $this->hasOne('App\Plan');
    }

    public function addPlan(Plan $id)
    {
        return $this->plans()->save();
    }
}
