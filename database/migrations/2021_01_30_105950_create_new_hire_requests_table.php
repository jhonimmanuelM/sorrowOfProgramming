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
            $table->string('skills');
            $table->integer('employee_type');
            $table->integer('billing');
            $table->integer('no_of_positions');
            $table->longtext('job_description');
            $table->integer('replacement');
            $table->string('replacement_for');
            $table->integer('approved_by');
            $table->integer('raised_by');
            $table->integer('status')->default(1);
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
