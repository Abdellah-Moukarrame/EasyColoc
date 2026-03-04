<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function depences()
    {
        return $this->hasMany(Depences::class);
    }

    protected $fillable = ['name', 'colocation_id'];
}
