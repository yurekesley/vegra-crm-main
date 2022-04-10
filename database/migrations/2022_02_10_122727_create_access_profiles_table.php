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
        Schema::create('access_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'deleted_at']);
        });

        Schema::create('permissions', function(Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('key', 100)->unique();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });

        Schema::create('access_profile_permissions', function(Blueprint $table) {
            $table->id();
            $table->integer('access_profile_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->foreign('access_profile_id')->references('id')->on('access_profiles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['access_profile_id', 'permission_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('access_profile_id')->nullable()->constrained('access_profiles', 'id');
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
            $table->dropConstrainedForeignId('access_profile_id');
        });
        Schema::dropIfExists('access_profile_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('access_profiles');
    }
};
