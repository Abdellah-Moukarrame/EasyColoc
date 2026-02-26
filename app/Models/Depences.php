<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depences extends Model
{
    public function user(){

    }
    public function colocation(){

    }


    protected $fillable=['name','amount','category_id','colocation_id','user_id'];
}
