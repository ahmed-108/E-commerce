<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class sub_categories extends Model
{
    protected $table= 'sub-category';
    protected $fillable=['id','category_id','sub_category_name','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];



    public function categories(){
        return $this->hasOne('App\Http\Models\categories');
    }
    public function products(){
        return $this->hasMany('App\Http\Models\products');
    }
}
