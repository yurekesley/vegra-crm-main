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
        Schema::table('proposal_histories', function(Blueprint $table) {
            $table->dropConstrainedForeignId('prospect_id');
            $table->foreignId('proposal_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposal_histories', function(Blueprint $table) {
            $table->dropConstrainedForeignId('proposal_id');
            $table->foreignId('prospect_id')->constrained();
        });
    }
};
