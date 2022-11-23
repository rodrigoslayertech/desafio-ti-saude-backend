<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteTelefones extends Model
{
    use HasFactory;

    protected $table = 'pacientes__telefones';

    public function paciente ()
    {
        return $this->belongsTo(Paciente::class);
    }
}
