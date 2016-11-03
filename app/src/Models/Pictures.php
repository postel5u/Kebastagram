<?php
/**
 * Created by PhpStorm.
 * User: gl55
 * Date: 02/11/2016
 * Time: 11:21
 */

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    protected $table = "pictures";
    protected $primaryKey ="id";
    public $timestamps = false;
}