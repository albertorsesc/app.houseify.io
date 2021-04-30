<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('slug', 100)->unique()->index();
            $table->string('title', 50);
            $table->foreignId('property_category_id')->constrained();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->string('business_type', 15);
            $table->unsignedInteger('price');
            $table->string('phone', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('comments')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('properties');
    }
}
