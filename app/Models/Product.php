<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // Habilita a Factory e o SoftDeletes (Lixeira)
    use HasFactory, SoftDeletes;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'user_id',
    ];

    // Um produto "pertence a" um Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
