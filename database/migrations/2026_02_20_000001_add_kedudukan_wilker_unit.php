<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->string('tempat_kedudukan')->nullable()->after('code');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->string('wilker')->nullable()->after('office_id');
            $table->string('unit')->nullable()->after('wilker');
        });
    }

    public function down(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->dropColumn('tempat_kedudukan');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['wilker', 'unit']);
        });
    }
};
