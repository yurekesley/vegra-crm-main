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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->index();
            $table->string('phone', 20);
            $table->boolean('whatsapp')->default(false);
            $table->string('responsible', 100);
            $table->string('cnpj', 14);
            $table->string('creci', 20);
            $table->enum('type', ['partner', 'house'])->nullable();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'deleted_at']);
            $table->unique(['email', 'deleted_at']);
            $table->unique(['cnpj', 'deleted_at']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('partner_id')->nullable()->constrained('partners', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('partner_id');
        });
        Schema::dropIfExists('partners');
    }
};
