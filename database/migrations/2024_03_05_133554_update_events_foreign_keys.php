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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['organizer_id']);

            $table->unsignedBigInteger('category_id')->nullable()->change();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('set null');

            $table->foreign('organizer_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['organizer_id']);

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('organizer_id')->references('id')->on('users');
        });
    }
};
