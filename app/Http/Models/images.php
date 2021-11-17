<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table= 'product_images';
    protected $fillable =['id','product_id','path','created_at','updated_at'];
    protected $hidden=['id','created_at','updated_at'];

    public function products(){
        return $this->belongsTo('App\Http\Models\products');
    }

}
