<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'ingredient', 'alternative', 'stars', 'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
