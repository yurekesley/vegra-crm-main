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
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('broker_id')->constrained('users', 'id');
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->foreignId('prospect_id')->constrained('prospects', 'id');
            $table->integer('available')->default(1);
            $table->integer('used')->default(0);
            $table->string('code', 30);
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
        //
    }
};
