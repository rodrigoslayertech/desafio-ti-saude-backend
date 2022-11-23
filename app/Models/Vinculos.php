<?php

namespace App\Models;

use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\PlanosController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculos extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['contrato', 'paciente', 'plano'];
}
