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
        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('section_id')->nullable()->constrained()->onDelete('set null')->after('category');
            $table->foreignId('year_level_id')->nullable()->constrained()->onDelete('set null')->after('section_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
            $table->dropForeign(['year_level_id']);
            $table->dropColumn(['section_id', 'year_level_id']);
        });
    }
};
