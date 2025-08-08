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
        Schema::table('destinations', function (Blueprint $table) {
            $table->float('average_rating')->default(0)->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('average_rating');
        });
    }
};
