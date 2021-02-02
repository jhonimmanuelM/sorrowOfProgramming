<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('position')->nullable();
            $table->string('skill_set')->nullable();
            $table->string('status')->nullable();
            $table->string('shorts_notes')->nullable();
            $table->string('resume')->nullable();
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
        Schema::dropIfExists('referrals');
    }
}
