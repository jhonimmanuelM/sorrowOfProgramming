<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewHireRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_hire_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('candidate_role_id');
            $table->integer('team_id');
            $table->integer('experience');
            $table->integer('skills');
            $table->integer('employee_type');
            $table->integer('billing');
            $table->integer('no_of_positions');
            $table->string('job_description');
            $table->string('replacement');
            $table->integer('approved_by');
            $table->integer('raised_by');
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
        Schema::dropIfExists('new_hire_requests');
    }
}
