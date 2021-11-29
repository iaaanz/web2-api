<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'quantidade',
        'ncm',
        'data',
        'cpf_cadastro'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'cpf_cadastro', 'cpf');
    }
}
