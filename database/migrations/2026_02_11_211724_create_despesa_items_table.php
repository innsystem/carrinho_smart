<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesa_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('despesa_id')->constrained('despesas')->onDelete('cascade');
            $table->string('nome');
            $table->decimal('quantidade', 8, 3)->default(1);
            $table->decimal('preco_unitario', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2)->default(0);
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
        Schema::dropIfExists('despesa_items');
    }
}
