<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table= 'orders';
    protected $fillable =[
        'id',
        'user_id',
        'total_invoice',
        'billing_details_ID',
        'status',
        'items',
        'created_at',
        'updated_at',
    ];
    protected $hidden=['created_at','updated_at'];

    public function user(){
        return $this->hasMany('App\Http\Models\user_login');
    }
    public function cart(){
        return $this->hasOne('App\Http\Models\Cart');

    }

}
