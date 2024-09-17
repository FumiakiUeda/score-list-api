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
        Schema::table('scores', function (Blueprint $table) {
            $table->text('name')->nullable()->change();
            $table->text('composer')->nullable()->change();
            $table->text('arranger')->nullable()->change();
            $table->text('note')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('composer')->change();
            $table->string('arranger')->change();
            $table->string('note')->change();
        });
    }
};
