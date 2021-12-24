<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table= 'cart';
    protected $fillable =['id','product_id','Sub_total','quantity','user_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function products(){
        return $this->hasMany('App\Http\Models\products');
    }
    public function user(){
        return $this->hasOne('App\Http\Models\user_login');
    }
    public function orders(){
        return $this->hasOne('App\Http\Models\orders');
    }
}
