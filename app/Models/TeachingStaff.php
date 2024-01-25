<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/teaching-staff/' .$image),
        );
    }
}