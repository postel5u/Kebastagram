<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $primaryKey ="uniqid";
    public $incrementing = false;
    public $timestamps = false;
}
