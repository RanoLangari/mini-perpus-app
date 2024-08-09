<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookCategory extends Model
{
    use HasFactory;

    protected $table = 'book_categories';
    protected $fillable = ['category_name'];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}