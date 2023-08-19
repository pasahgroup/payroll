<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDetailsToAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details_to_allowance', function (Blueprint $table) {
            $table->increments('salary_details_to_allowance_id');
            $table->integer('salary_details_id');
            $table->integer('allowance_id');
            $table->double('amount_of_allowance')->default(0);
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
        Schema::dropIfExists('salary_details_to_allowance');
    }
}
