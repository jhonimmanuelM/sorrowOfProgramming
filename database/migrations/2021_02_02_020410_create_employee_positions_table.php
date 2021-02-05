<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->timestamps();
        });

        $insert_data[]['position'] = 'Software Engineer';
        $insert_data[]['position'] = 'UI/UX Developer';
        $insert_data[]['position'] = 'UI/UX Designer';
        $insert_data[]['position'] = 'Content Writers';
        $insert_data[]['position'] = 'Digital Marketers';
        $insert_data[]['position'] = 'Accountant';
        $insert_data[]['position'] = 'HR';
        $insert_data[]['position'] = 'Office Admin';

        DB::table('employee_positions')->insert($insert_data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_positions');
    }
}
