<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Category extends Component
{
    protected $table = 'categories';

    protected $fillable = [
        'user_id',
        'name',
        'color',
    ];
}
