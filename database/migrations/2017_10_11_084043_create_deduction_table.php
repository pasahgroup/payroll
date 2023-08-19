<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduction', function (Blueprint $table) {
            $table->increments('deduction_id');
            $table->string('deduction_name', 250);
            $table->string('deduction_type', 100);
            $table->double('percentage_of_basic')->default(0);
            $table->double('limit_per_month')->default(0);
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
        Schema::dropIfExists('deduction');
    }
}
