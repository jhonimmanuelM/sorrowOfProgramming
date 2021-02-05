<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferalSkillSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referal_skill_sets', function (Blueprint $table) {
            $table->id();
            $table->string('skill');
            $table->timestamps();
        });

        $insert_data[]['skill'] = 'PHP';
        $insert_data[]['skill'] = 'Laravel';
        $insert_data[]['skill'] = 'Magento';
        $insert_data[]['skill'] = 'Bigcommerce';
        $insert_data[]['skill'] = 'Python';
        $insert_data[]['skill'] = '.net';
        $insert_data[]['skill'] = 'AI';
        $insert_data[]['skill'] = 'ML';

        DB::table('referal_skill_sets')->insert($insert_data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referal_skill_sets');
    }
}
