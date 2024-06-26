<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'research_title',
        'year',
        'type'
    ];
}
