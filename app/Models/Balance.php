<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'balance', 'user_id'
    ];

    protected $casts = [
        'balance' => 'float(8, 2)'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
}
