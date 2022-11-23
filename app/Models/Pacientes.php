<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['nome'];
    protected $casts = [
        'dataNascimento' => 'date'
    ];

    public function telefones ()
    {
        return $this->hasMany(PacientesTelefones::class, 'paciente');
    }
    public function vinculos ()
    {
        return $this->hasMany(Vinculos::class, 'paciente', 'id');
    }
}
