<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table= 'comments';
    protected $fillable=['id','comment','rating','user_id','product_id','created_at','updated_at'];

    public function user(){
        return $this->hasOne('App\Models\user_login');
    }
    public function product(){
        return $this->belongsTo('App\Models\products');
    }


}
