<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class user_login  extends Authenticatable implements JWTSubject
{
    protected $table= 'user_login';
    protected $fillable =['id','username','email','password','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function comments(){
        return $this->hasMany('App\Http\Models\Comments');
    }

}
