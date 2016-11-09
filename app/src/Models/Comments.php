<?php
/**
 * Created by PhpStorm.
 * User: debian
 * Date: 07/11/16
 * Time: 16:38
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

    protected $table = "comments";
    protected $primaryKey ="uniqid";
    public $incrementing = false;
    public $timestamps = false;
}