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
        // r:const_proc
        Schema::create('cons_proc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta');
            $table->unsignedBigInteger('procedimento');

            $table->foreign('consulta')->references('id')->on('consultas');
            $table->foreign('procedimento')->references('id')->on('procedimentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cons_proc');
    }
};
