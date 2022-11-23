<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'data',
        'hora',
        'particular',

        'paciente',
        'vinculo',
        // 'procedimento',
        'medico'
    ];
    protected $casts = [
        'data' => 'date',
        'hora' => 'datetime'
    ];

    public function paciente ()
    {
        return $this->hasOne(Pacientes::class, 'paciente', 'paciente');
    }
    public function vinculo () // convênio
    {
        return $this->hasOne(Vinculos::class, 'vinculo', 'vinculo');
    }
    public function procedimento ()
    {
        return $this->hasOne(Vinculos::class, 'procedimento', 'procedimento');
    }
    public function medico ()
    {
        return $this->hasOne(Vinculos::class, 'medico', 'medico');
    }
}
