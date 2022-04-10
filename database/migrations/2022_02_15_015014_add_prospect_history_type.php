<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prospect_histories', function(Blueprint $table) {
            $table->string('ip', 30)->nullable();
            $table->enum('type', ['status', 'data', 'log'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prospect_histories', function(Blueprint $table) {
            $table->dropColumn('ip');
            $table->dropColumn('type');
        });
    }
};
