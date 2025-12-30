<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Só permite salvar estes campos via formulário
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'user_id', // Importante para saber quem criou
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}