<?php
/**
 * Created by PhpStorm.
 * User: gl55
 * Date: 05/11/2016
 * Time: 13:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    protected $table = "follows";
    protected $primaryKey ="id_user";
    public $incrementing = false;
    public $timestamps = false;
}
