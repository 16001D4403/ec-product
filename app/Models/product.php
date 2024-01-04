<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', // Add 'name' to the $fillable array
        'price',
        'description',
        'image',
        // Other fields in your Product model
    ];
}
