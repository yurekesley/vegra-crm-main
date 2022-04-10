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
        Schema::create('product_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->enum('type', ['general', 'pictures', 'blueprint', 'price_table', 'documents', 'sales_marketing', 'videos', 'pre_proposal']);
            $table->string('title', 100);
            $table->string('url', 1000)->nullable();
            $table->text('description')->nullable();
            $table->text('json_content')->nullable();
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
        Schema::dropIfExists('product_contents');
    }
};
