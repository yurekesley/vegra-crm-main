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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 50);
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->decimal('house_commission_value', 16, 2, true)->default(0);
            $table->decimal('partner_commission_value', 16, 2, true)->default(0);
            $table->enum('commission_payer', ['incorporator', 'customer'])->nullable();
            $table->boolean('show_commission_on_proposals')->default(false);
            $table->boolean('enable_prospects')->default(false);
            $table->boolean('sort_prospects')->default(false);
            $table->boolean('allow_customer_without_broker')->default(false);
            $table->boolean('allow_proposals')->default(false);
            $table->text('welcome_text')->nullable();
            $table->boolean('show_for_customers')->default(false);
            $table->text('qualification_text')->nullable();
            $table->string('logo_url', 2000)->nullable();
            $table->foreignId('fake_broker_id')->nullable()->constrained('users', 'id');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'deleted_at']);
            $table->unique(['slug', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
