<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 100);
            $table->date('birthdate_at')->nullable();
            $table->json('skills');
            $table->string('email', 150)->nullable();
            $table->string('phone', 60)->nullable();
            $table->string('facebook_profile', 255)->nullable();
            $table->string('site', 255)->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('job_profiles');
    }
}
