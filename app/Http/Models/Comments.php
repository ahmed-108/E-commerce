<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table= 'comments';
    protected $fillable=['id','comment','rating','user_id','product_id','created_at','updated_at'];

    public function user(){
        return $this->hasOne('App\Http\Models\user_login');
    }
    public function product(){
        return $this->belongsTo('App\Http\Models\products');
    }


}
