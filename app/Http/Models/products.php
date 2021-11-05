<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table= 'products';
    protected $fillable=['id','sub_category_id','category_id','title','short_description','long_description','price','product_imagesID','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function images(){
        return $this->hasMany('App\Http\Models\images');
    }
    public function subcategories(){
        return $this->hasOne('App\Http\Models\sub_categories');
    }
    public function category(){
        return $this->hasOne('App\Http\Models\categories');
    }

}
