<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'user_id', 'title', 'ingredients', 'steps',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    // ✅ Add this to support multiple images
    public function images()
    {
        return $this->hasMany(\App\Models\RecipeImage::class);
    }
}

