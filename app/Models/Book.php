<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // If you use a different table name, specify it here
    // protected $table = 'your_table_name';

    // If your primary key is not 'id' or you don't use auto-incrementing IDs, specify that here
    // protected $primaryKey = 'your_primary_key';
    // public $incrementing = false;

    // If you don't want to use timestamps (created_at and updated_at), set this to false
    // public $timestamps = false;

    // List of attributes that are mass assignable
    protected $fillable = [
        'Title', 'Author', 'ISBN', 'Genre', 'Publisher', 'Year', 'Price','image','description'
        // Add other columns as necessary
    ];
    protected $primaryKey = 'BookID';

    // Add any relationships, accessors, mutators, and business logic here as needed
}
