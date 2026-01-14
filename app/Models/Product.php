<?php

declare(strict_types=1);

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
        'category_id', // Adiciona a categoria
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
