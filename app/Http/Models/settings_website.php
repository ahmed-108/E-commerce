<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class settings_website extends Model
{
    protected $table= 'settings_website';
    protected $fillable =['id','phone','hotline','address','hours','facebook','insta','pinterest','twitter','youtube','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];


}
