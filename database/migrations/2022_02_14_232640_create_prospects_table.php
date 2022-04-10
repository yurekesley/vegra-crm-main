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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('cpf_cnpj', 14)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->enum('marital_state', ['single', 'married', 'divorced', 'widowed', 'undefined']);
            $table->text('customer_preferences')->nullable();
            $table->string('rg', 20)->nullable();
            $table->string('nationality', 50)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('marriage_regime', ['none', 'partial_goods_community', 'universal_goods_community', 'goods_separation', 'final_participation_in_aquests'])->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('complement', 30)->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->string('number', 10)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 2)->nullable();
            $table->foreignId('broker_id')->constrained('users');
            $table->enum('status', ['temp', 'open', 'approved', 'rejected']);
            $table->foreignId('product_id')->constrained();
            $table->boolean('has_coparticipant')->default(false);
            $table->string('copart_name', 100)->nullable();
            $table->string('copart_cpf_cnpj', 14)->nullable();
            $table->string('copart_phone', 20)->nullable();
            $table->string('copart_email', 100)->nullable();
            $table->string('copart_occupation', 100)->nullable();
            $table->enum('copart_marital_state', ['single', 'married', 'divorced', 'widowed', 'undefined'])->nullable();
            $table->enum('copart_marriage_regime', ['none', 'partial_goods_community', 'universal_goods_community', 'goods_separation', 'final_participation_in_aquests'])->nullable();
            $table->boolean('has_broker')->default(false);
            $table->decimal('total_incoming', 16, 2)->default(0);
            $table->string('copart_zipcode', 20)->nullable();
            $table->string('copart_address', 100)->nullable();
            $table->string('copart_number', 10)->nullable();
            $table->string('copart_complement', 20)->nullable();
            $table->string('copart_neighborhood', 50)->nullable();
            $table->string('copart_city', 50)->nullable();
            $table->string('copart_state', 2)->nullable();
            $table->string('copart_nationality', 50)->nullable();
            $table->date('copart_birth_date')->nullable();
            $table->string('document_code', 100)->nullable();
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
        Schema::dropIfExists('prospects');
    }
};
