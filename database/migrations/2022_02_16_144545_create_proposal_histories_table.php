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
        Schema::create('proposal_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->constrained();
            $table->string('ip', 30)->nullable();
            $table->enum('type', ['status', 'data', 'log'])->nullable();
            $table->string('content', 1000);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_histories');
    }
};
