<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table= 'categories';
    protected $fillable= ['id','category','category_image','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function sub_categories(){
        return $this->hasMany('App\Models\sub_categories');
    }
    public function products(){
        return $this->hasMany('App\Models\products');
    }

}
