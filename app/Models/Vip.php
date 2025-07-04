<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'price',
        'duration_days',
        'start_at',
        'end_at',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
