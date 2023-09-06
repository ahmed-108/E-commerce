<?php

namespace App\Models;

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

    public function user(){
        return $this->hasMany('App\Models\user_login');
    }
    public function cart(){
        return $this->hasOne('App\Models\Cart');

    }

}
