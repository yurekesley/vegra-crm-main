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
        Schema::create('product_gdprs', function(Blueprint $table) {
            $table->id();
            $table->enum('type', ['prospect', 'prospect_associate', 'proposal', 'legal_text']);
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->text('content')->nullable();
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
        Schema::dropIfExists('product_gdprs');
    }
};
