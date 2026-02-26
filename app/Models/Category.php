<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function colocation(){

    }
    public function depences(){

    }
    protected $fillable = ['name','colocation_id'];
}
