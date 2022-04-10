<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $all = DB::table('units')->get();

        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('post_keys_financing_type');
        });

        Schema::table('units', function (Blueprint $table) {
            $table->enum('post_keys_financing_type', ['incorporator', 'bank'])->default('incorporator');
        });

        foreach ($all as $item) {
            DB::table('units')->where('id', $item->id)->update(['post_keys_financing_type' => $item->post_keys_financing_type]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $all = DB::table('units')->get();

        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('post_keys_financing_type');
        });

        Schema::table('units', function (Blueprint $table) {
            $table->enum('post_keys_financing_type', ['incorporator', 'bank']);
        });

        foreach ($all as $item) {
            DB::table('units')->where('id', $item->id)->update(['post_keys_financing_type' => $item->post_keys_financing_type]);
        }
    }
};
