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
        Schema::table('temp_unit_imports', function (Blueprint $table) {
            $table->enum('status', ['temp', 'validating', 'sync', 'updatable', 'instertable', 'deletable'])->default('temp');
            $table->string('message', 4000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_unit_imports', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->string('message', 4000)->nullable(false)->default('')->change();
        });
    }
};
