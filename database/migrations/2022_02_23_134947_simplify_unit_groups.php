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
        Schema::table('unit_groups', function (Blueprint $table) {
            $table->dropColumn('has_pre_keys');
            $table->dropColumn('discount_on_cash');
            $table->dropColumn('pre_keys_spot');
            $table->dropColumn('pre_keys_monthly');
            $table->dropColumn('pre_keys_intermediate');
            $table->dropColumn('inflow');
            $table->dropColumn('post_keys_monthly');
            $table->dropColumn('post_keys_intermediate');
            $table->dropColumn('financing');
            $table->dropColumn('pre_keys_spot_month');
            $table->dropColumn('monthly_qty');
            $table->dropColumn('monthly_start');
            $table->dropColumn('intermediate_start_1');
            $table->dropColumn('intermediate_start_2');
            $table->dropColumn('intermediate_start_3');
            $table->dropColumn('intermediate_start_4');
            $table->dropColumn('intermediate_start_5');
            $table->dropColumn('intermediate_start_6');
            $table->dropColumn('post_keys_financing_type');
            $table->dropColumn('financing_monthly_qty');
            $table->dropColumn('financing_monthly_start');
            $table->dropColumn('financing_monthly_has_interest_rate');
            $table->dropColumn('financing_monthly_interest_rate');
            $table->dropColumn('financing_yearly_qty');
            $table->dropColumn('financing_yearly_start');
            $table->dropColumn('financing_yearly_has_interest_rate');
            $table->dropColumn('financing_yearly_interest_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unit_groups', function (Blueprint $table) {
            $table->date('delivery_forecast')->nullable();
            $table->boolean('has_pre_keys')->default(true);
            $table->decimal('discount_on_cash')->default(0);
            $table->decimal('pre_keys_spot')->nullable();
            $table->decimal('pre_keys_monthly')->nullable();
            $table->decimal('pre_keys_intermediate')->nullable();
            $table->decimal('inflow')->default(0);
            $table->decimal('post_keys_monthly')->default(0);
            $table->decimal('post_keys_intermediate')->default(0);
            $table->decimal('financing')->default(0);
            $table->date('pre_keys_spot_month');
            $table->integer('monthly_qty')->unsigned()->nullable();
            $table->date('monthly_start')->nullable();
            $table->date('intermediate_start_1')->nullable();
            $table->date('intermediate_start_2')->nullable();
            $table->date('intermediate_start_3')->nullable();
            $table->date('intermediate_start_4')->nullable();
            $table->date('intermediate_start_5')->nullable();
            $table->date('intermediate_start_6')->nullable();
            $table->enum('post_keys_financing_type', ['incorporator', 'bank'])->nullable();
            $table->integer('financing_monthly_qty')->nullable();
            $table->date('financing_monthly_start')->nullable();
            $table->boolean('financing_monthly_has_interest_rate')->default(true);
            $table->decimal('financing_monthly_interest_rate')->nullable();
            $table->integer('financing_yearly_qty')->nullable();
            $table->date('financing_yearly_start')->nullable();
            $table->boolean('financing_yearly_has_interest_rate')->default(true);
            $table->decimal('financing_yearly_interest_rate')->nullable();
        });
    }
};
