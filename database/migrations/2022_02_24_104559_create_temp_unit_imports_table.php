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
        Schema::create('temp_unit_imports', function (Blueprint $table) {
            $table->id();
            $table->string('type', 30);
            $table->string('type_number', 20);
            $table->string('unit_number', 20);
            $table->decimal('size', 16, 2)->nullable();
            $table->decimal('price', 16, 2)->nullable();
            $table->string('sun', 50)->nullable();
            $table->integer('floor');
            $table->date('delivery_forecast')->nullable();
            $table->boolean('has_pre_keys')->nullable();
            $table->date('pre_keys_spot_month')->nullable();
            $table->decimal('inflow', 16, 8)->nullable();
            $table->integer('pre_keys_monthly_qty')->nullable();
            $table->decimal('pre_keys_monthly_value', 16, 8)->nullable();
            $table->date('pre_keys_monthly_start')->nullable();
            $table->decimal('pre_keys_intermediate_value', 16, 8)->nullable();
            $table->date('intermediate_start_1')->nullable();
            $table->date('intermediate_start_2')->nullable();
            $table->date('intermediate_start_3')->nullable();
            $table->date('intermediate_start_4')->nullable();
            $table->date('intermediate_start_5')->nullable();
            $table->date('intermediate_start_6')->nullable();
            $table->string('financing_type', 50)->nullable();
            $table->integer('financing_monthly_qty')->nullable();
            $table->decimal('financing_monthly_value', 16, 8)->nullable();
            $table->date('financing_monthly_start')->nullable();
            $table->integer('financing_yearly_qty')->nullable();
            $table->decimal('financing_yearly_value', 16, 8)->nullable();
            $table->date('financing_yearly_start')->nullable();
            $table->text('description')->nullable();
            $table->integer('line');
            $table->string('message', 4000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_unit_imports');
    }
};
