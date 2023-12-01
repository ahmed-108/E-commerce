<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table= 'products';
    protected $fillable=[
        'id',
        'sub_category_id',
        'old_price',
        'discount',
        'category_id',
        'title',
        'short_description',
        'long_description',
        'price',
        'product_imagesID',
        'created_at',
        'updated_at'
    ];
    protected $hidden=['created_at','updated_at'];

    public function images(){
        return $this->hasMany(images::class,'product_id','id');
    }
    public function subcategories(){
        return $this->hasOne('App\Models\sub_categories');
    }
    public function category(){
        return $this->hasOne('App\Models\categories');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comments');
    }
}
