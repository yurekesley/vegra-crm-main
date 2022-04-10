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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('code_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('prospect_id')->constrained();
            $table->foreignId('unit_id')->constrained();
            $table->foreignId('broker_id')->constrained('users', 'id');
            $table->enum('status', ['temp', 'open', 'approved', 'rejected']);
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
        Schema::dropIfExists('proposals');
    }
};
