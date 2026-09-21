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
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('harga')->default('0')->change();
            // Menambahkan kolom satuan setelah kolom harga
            $table->string('satuan_harga')->default('PENGAJUAN')->after('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->integer('harga')->default(0)->change();
            $table->dropColumn('satuan_harga');
        });
    }
};
