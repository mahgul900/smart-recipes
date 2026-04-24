<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecipeImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'path',
    ];

    // timestamps enabled (table has created_at / updated_at)

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

