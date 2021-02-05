<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('team',50);
            $table->timestamps();
        });

        $insert_data[]['team'] = 'Services';
        $insert_data[]['team'] = 'Marketing';
        $insert_data[]['team'] = 'HR';
        $insert_data[]['team'] = 'Accounts';
        $insert_data[]['team'] = 'QA Touch';
        $insert_data[]['team'] = 'Cloras';
        $insert_data[]['team'] = 'flexiPIM';
        $insert_data[]['team'] = 'Vizby';

        DB::table('teams')->insert($insert_data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
