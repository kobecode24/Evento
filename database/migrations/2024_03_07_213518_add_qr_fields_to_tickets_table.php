<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('qr_url')->nullable()->after("ticket_unique_id");
            $table->string('qr_public_id')->nullable()->after('qr_url');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['qr_url', 'qr_public_id']);
        });
    }
};
