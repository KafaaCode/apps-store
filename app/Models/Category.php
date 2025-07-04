<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'active'
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

}
