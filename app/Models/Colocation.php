<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = ['name', 'status'];
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function depences()
    {
        return $this->hasMany(Depences::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->withPivot('type', 'status', 'solde', 'joined_at', 'left_at', 'token')
            ->withTimestamps();
    }
}
