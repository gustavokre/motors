<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supplier_id')->unsigned();
            $table->string("external_car_id"); // id do carro no sistema do fornecedor (string motivo:compatibilidade melhor)
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->string('version');
            $table->string('color');
            $table->integer('km');
            $table->string('fuel')->nullable();
            $table->string('gear')->nullable();
            $table->integer('doors')->nullable();
            $table->decimal('price', 10,2);
            $table->timestamps();

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
