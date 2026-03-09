<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddOrdemToDespesaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('despesa_items', function (Blueprint $table) {
            $table->unsignedTinyInteger('ordem')->default(1)->after('despesa_id');
        });

        $despesaIds = DB::table('despesa_items')->select('despesa_id')->distinct()->pluck('despesa_id');
        foreach ($despesaIds as $despesaId) {
            $itens = DB::table('despesa_items')
                ->where('despesa_id', $despesaId)
                ->orderBy('id')
                ->get(['id']);

            $ordem = 1;
            foreach ($itens as $item) {
                DB::table('despesa_items')
                    ->where('id', $item->id)
                    ->update(['ordem' => min(99, $ordem)]);
                $ordem++;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('despesa_items', function (Blueprint $table) {
            $table->dropColumn('ordem');
        });
    }
}
