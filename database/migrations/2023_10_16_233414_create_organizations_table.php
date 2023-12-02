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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('rut')->unique();
            $table->string('email')->nullable();
            $table->boolean('status')->default(false);
            $table->string('sistem');
            $table->foreignId('user_id')->nullable()->constrained('users');
            // $table->unique(['rut','sistem']);
            // $table->index(['rut','sistem']);

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
        Schema::dropIfExists('organizations');
    }
};
