<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user_login extends Authenticatable
{
    protected $table= 'user_login';
    protected $fillable =['id','username','email','password','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];



}
