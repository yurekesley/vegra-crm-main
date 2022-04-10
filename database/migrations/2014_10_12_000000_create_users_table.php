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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('user_type', ['admin', 'partner', 'broker'])->nullable();
            $table->enum('user_status', ['pending', 'active', 'inactive', 'blocked'])->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('phone', 20)->nullable();
            $table->boolean('whatsapp')->default(false);
            $table->string('creci', 20)->nullable();
            $table->date('birth_date')->nullable();            
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('manager_id')->nullable()->constrained('users', 'id');
            $table->foreignId('director_id')->nullable()->constrained('users', 'id');

            $table->unique(['email', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
