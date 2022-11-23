<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planos extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['descricao', 'telefone'];

    public function vinculos ()
    {
        return $this->hasMany(Vinculos::class, 'plano', 'id');
    }
}
