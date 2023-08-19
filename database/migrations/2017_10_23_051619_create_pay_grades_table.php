<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_grade', function (Blueprint $table) {
            $table->increments('pay_grade_id');
            $table->string('pay_grade_name', 150)->unique();
            $table->double('gross_salary');
            $table->double('percentage_of_basic');
            $table->double('basic_salary');
            $table->double('overtime_rate')->nullable()->default(0);
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
        Schema::dropIfExists('pay_grade');
    }
}
