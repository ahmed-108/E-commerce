<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table= 'cart';
    protected $fillable =['id','product_id','Sub_total','quantity','user_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function products(){
        return $this->hasMany('App\Mdels\products');
    }
    public function user(){
        return $this->hasOne('App\Models\user_login');
    }
    public function orders(){
        return $this->hasOne('App\Models\orders');
    }
}
