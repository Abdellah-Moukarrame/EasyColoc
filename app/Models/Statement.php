<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $fillable = [
        'user_id',
        'colocation_id',
        'depence_id',
        'amount_to_pay',
        'receiver_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function depence()
    {
        return $this->belongsTo(Depences::class,'depence_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
