<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contact_us extends Model
{
    protected $table= 'contact_us';
    protected $fillable =[
        'id',
        'first_name',
        'email',
        'phone',
        'subject',
        'message',
        'created_at',
        'updated_at',
    ];

}
