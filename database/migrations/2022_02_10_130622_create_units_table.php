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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->foreignId('unit_group_id')->constrained('unit_groups', 'id');
            $table->decimal('size', 16, 2)->default(0);
            $table->string('number', 20);
            $table->enum('sun', ['morning', 'afternoon', 'any'])->nullable();
            $table->decimal('price', 16, 2)->nullable();
            $table->integer('floor');
            $table->string('final_number', 10);
            $table->date('delivery_forecast')->nullable();
            $table->integer('parking_lots')->nullable();
            $table->boolean('has_pre_keys')->default(true);
            $table->date('pre_keys_spot_month')->nullable();
            $table->integer('pre_keys_monthly_qty')->nullable();
            $table->decimal('pre_keys_monthly_value')->nullable();
            $table->date('pre_keys_monthly_start')->nullable();
            $table->decimal('pre_keys_intermediate_value')->nullable();
            $table->date('intermediate_start_1')->nullable();
            $table->date('intermediate_start_2')->nullable();
            $table->date('intermediate_start_3')->nullable();
            $table->date('intermediate_start_4')->nullable();
            $table->date('intermediate_start_5')->nullable();
            $table->date('intermediate_start_6')->nullable();
            $table->enum('post_keys_financing_type', ['incorporator', 'bank']);
            $table->integer('financing_monthly_qty')->nullable();
            $table->decimal('financing_monthly_value')->nullable();
            $table->date('financing_monthly_start')->nullable();
            $table->integer('financing_yearly_qty')->nullable();
            $table->decimal('financing_yearly_value')->nullable();
            $table->date('financing_yearly_start')->nullable();
            $table->decimal('inflow', 16, 2, true)->nullable();
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
        Schema::dropIfExists('units');
    }
};
