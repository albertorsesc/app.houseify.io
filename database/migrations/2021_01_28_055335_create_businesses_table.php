<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->unique();
            $table->uuid('uuid')->unique();
            $table->string('slug')->unique();
            $table->foreignId('owner_id')->constrained('users');
            $table->json('categories');
            $table->string('email', 150)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('site')->nullable();
            $table->boolean('status')->default(false);
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
