<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDetailsToDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details_to_deduction', function (Blueprint $table) {
            $table->increments('salary_details_to_deduction_id');
            $table->integer('salary_details_id');
            $table->integer('deduction_id');
            $table->double('amount_of_deduction');
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
        Schema::dropIfExists('salary_details_to_deduction');
    }
}
