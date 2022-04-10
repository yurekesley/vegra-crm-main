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
        Schema::create('proposal_payments', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['pre_keys', 'post_keys']);
            $table->enum('type', ['cash', 'monthly', 'intermediate']);
            $table->integer('installments');
            $table->date('start_date');
            $table->decimal('installment_value', 16, 8);
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
        Schema::dropIfExists('proposal_payments');
    }
};
