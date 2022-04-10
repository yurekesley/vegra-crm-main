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
        Schema::create('prospect_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->constrained();
            $table->enum('type', ['cpf_cnh', 'rg', 'comp_res', 'com_est_civil', 'advb_est_civil', 'com_renda', 'other']);
            $table->string('url', 1000);
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
        Schema::dropIfExists('prospect_documents');
    }
};
