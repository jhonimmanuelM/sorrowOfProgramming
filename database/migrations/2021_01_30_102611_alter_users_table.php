<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->bigInteger('mobile_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->bigInteger('emergency_contact_number')->nullable();
            $table->string('father_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('role_id')->nullable();
            $table->integer('team_id')->nullable();
        });

        DB::table('users')->insert(
            array(
                array(
                    'name'    => 'Super Admin',
                    'email'    => 'admin@blackbox.com',
                    'first_name'    => 'Super',
                    'last_name'    => 'Admin',
                    'employee_number'    => '1',
                    'gender_id'    => '1',
                    'manager_id'    => '1',
                    'status'    => '1',
                    'date_of_joining'    => Carbon::now(),
                    'probation_period'    => '1',
                    'mobile_number'    => '9988776655',
                    'emergency_contact_name'    => 'NA',
                    'emergency_contact_number'    => '9988776655',
                    'father_name'    => 'NA',
                    'spouse_name'    => 'NA',
                    'password'      => '$2y$10$GFyeGJrmd9VJrellIGfmCu3lmvO26indLDc8n/Xl3tbiRWqq7JJAi',
                    'remember_token'=> 'ehip5cdHqkzEuVy2b9dMzSEef13jgqgp5Mh4BZzOwIPyU48L94XDgrcxGPAs',
                    'created_at'    => Date('Y-m-d H:i:s'),
                    'updated_at'    => Date('Y-m-d H:i:s')
                )
            )
        );

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
