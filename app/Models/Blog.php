<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'blogcategory_id'
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/blogs/' .$image),
        );
    }

    public function blogcategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blogcategory_id');
    }
}
