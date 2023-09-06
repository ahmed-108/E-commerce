<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class billing_details extends Model
{
    protected $table= 'billing_details';
    protected $fillable =[
        'id',
        'user_id',
        'full_name',
        'phone1',
        'phone2',
        'country',
        'city',
        'zip_code',
        'full_address',
        'notes',
        'payment_method',
        'created_at',
        'updated_at'
    ];
    protected $hidden=['created_at','updated_at'];

    public function user(){
        return $this->hasOne('App\Http\Models\user_login');
    }

}
