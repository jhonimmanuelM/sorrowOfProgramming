<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('first_name')->nullable()    ;
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('employee_number')->unique();
            $table->integer('gender_id')->nullable();
            $table->integer('manager_id')->nullable();
            $table->integer('status')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('probation_period')->nullable();
            $table->integer('mobile_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->integer('emergency_contact_number')->nullable();
            $table->string('father_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('team_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('employee_number');
            $table->dropColumn('gender_id');
            $table->dropColumn('manager_id');
            $table->dropColumn('status');
            $table->dropColumn('date_of_joining');
            $table->dropColumn('probation_period');
            $table->dropColumn('mobile_number');
            $table->dropColumn('emergency_contact_name');
            $table->dropColumn('emergency_contact_number');
            $table->dropColumn('father_name');
            $table->dropColumn('spouse_name');
            $table->dropColumn('role_id');
            $table->dropColumn('team_id');
        });
    }
}
