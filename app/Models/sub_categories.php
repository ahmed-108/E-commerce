<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sub_categories extends Model
{
    protected $table= 'sub-category';
    protected $fillable=['id','category_id','sub_category_name','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];



    public function categories(){
        return $this->hasOne('App\Models\categories');
    }
    public function products(){
        return $this->hasMany('App\Models\products');
    }
}
