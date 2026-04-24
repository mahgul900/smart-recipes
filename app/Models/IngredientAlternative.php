<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientAlternative extends Model
{
    protected $fillable = [
        'ingredient',
        'alternative',
        'notes',
    ];
}
