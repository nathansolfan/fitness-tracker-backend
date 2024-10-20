<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'duration',
        'date',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

}

