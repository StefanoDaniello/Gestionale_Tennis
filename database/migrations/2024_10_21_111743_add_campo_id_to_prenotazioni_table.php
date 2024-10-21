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
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->unsignedBigInteger('campo_id')->after('End_Time'); 

            // Definisci la chiave esterna se necessario
            $table->foreign('campo_id')->references('id')->on('campi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->dropForeign(['campo_id']); 
            $table->dropColumn('campo_id');
        });
    }
};
