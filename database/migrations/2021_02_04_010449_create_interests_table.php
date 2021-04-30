<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interested_by')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('interestable_id');
            $table->string('interestable_type', 100);
            $table->timestamps();

            $table->unique(['interested_by', 'interestable_id', 'interestable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interests');
    }
}
