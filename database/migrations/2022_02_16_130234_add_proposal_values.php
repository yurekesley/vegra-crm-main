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
        Schema::table('proposals', function(Blueprint $table) {
            $table->decimal('unit_price', 16, 8)->nullable();
            $table->decimal('house_commission_value', 16, 8)->nullable();
            $table->decimal('partner_commission_value', 16, 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposals', function(Blueprint $table) {
            $table->dropColumn('unit_price');
            $table->dropColumn('house_commission_value');
            $table->dropColumn('partner_commission_value');
        });
    }
};
