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
        Schema::create('detalle_ingresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_medicamento")->nullable();
            $table->foreign("id_medicamento")->references("id")->on("medicamentos")
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer("det_ing_cantidad");
            $table->integer("det_ing_lote");
            $table->unsignedBigInteger("det_ingreso_id")->nullable();
            $table->foreign("det_ingreso_id")->references("id")->on("ingresos")
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ingresos');
    }
};
