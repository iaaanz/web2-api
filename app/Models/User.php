<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'cpf',
        'data',
        'cnpj_empresa'
    ];

    public function companies()
    {
        return $this->belongsTo(Company::class, 'cnpj_empresa', 'cnpj');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cpf_cadastro', 'cpf');
    }
}
