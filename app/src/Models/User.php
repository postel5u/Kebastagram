<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $primaryKey ="uniqid";
    public $incrementing = false;
    public $timestamps = false;

    public function pictures()

    {

        return $this->belongsToMany('App\Models\Pictures','users_pictures','id_pictures','id_users');

    }
}