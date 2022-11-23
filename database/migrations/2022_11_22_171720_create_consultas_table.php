<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // e:consulta
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->dateTime('hora');
            $table->boolean('particular');

            $table->foreignId('vinculo')->nullable()->constrained('vinculos'); // r:pac_vinculo_plan
            $table->foreignId('paciente')->constrained('pacientes'); // r:cons_pac
            $table->foreignId('medico')->constrained('medicos'); // r:cons_med
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
};
