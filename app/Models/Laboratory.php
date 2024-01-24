<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug', 
        'content',
        'image'
    ];
    protected $primaryKey = 'slug';
    public $incrementing = false;

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/laboratories/' .$image),
        );
    }
}
