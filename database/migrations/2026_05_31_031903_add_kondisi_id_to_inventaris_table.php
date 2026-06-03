<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {

            $table->foreignId('kondisi_id')
                ->nullable()
                ->after('kategori_id')
                ->constrained('kondisis')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {

            $table->dropForeign(['kondisi_id']);
            $table->dropColumn('kondisi_id');

        });
    }
};
