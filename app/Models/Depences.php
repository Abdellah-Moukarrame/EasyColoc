<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depences extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function statements()
    {
        return $this->hasMany(Statement::class,'depence_id');
    }


    protected $fillable = ['name', 'amount', 'category_id', 'colocation_id', 'user_id'];
}
