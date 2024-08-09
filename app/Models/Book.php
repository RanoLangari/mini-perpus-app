<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 
        'kategori_id', 
        'deskripsi', 
        'jumlah', 
        'file_buku', 
        'cover_buku',
        'user_id' 
    ]; 

    public function kategori()
    {
        return $this->belongsTo(bookCategory::class, 'kategori_id');
    } 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}