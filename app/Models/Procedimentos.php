<?php

namespace App\Models;

use Freshleafmedia\MoneyCast\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimentos extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'nome',
        'valor',
    ];
    protected $casts = [
        'valor' => MoneyCast::class,
    ];
}
