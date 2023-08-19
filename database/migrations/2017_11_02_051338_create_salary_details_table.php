<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details', function (Blueprint $table) {
            $table->increments('salary_details_id');
            $table->integer('employee_id');
            $table->string('month_of_salary', 20);
            $table->double('basic_salary')->default('0');
            $table->double('total_allowance')->default('0');
            $table->double('total_deduction')->default('0');
            $table->integer('total_late')->default('0');
            $table->double('total_late_amount')->default('0');
            $table->integer('total_absence')->default('0');
            $table->double('total_absence_amount')->default('0');
            $table->double('overtime_rate')->default('0');
            $table->double('per_day_salary')->default('0');
            $table->string('total_over_time_hour', 50)->default('00:00');
            $table->double('total_overtime_amount')->default('0');
            $table->double('hourly_rate')->default('0');
            $table->integer('total_present')->default('0');
            $table->integer('total_leave')->default('0');
            $table->integer('total_working_days')->default('0');
            $table->double('net_salary')->default('0');
            $table->double('tax')->default('0');
            $table->double('taxable_salary')->default('0');
            $table->string('working_hour')->default('00:00');
            $table->double('gross_salary')->default('0');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->tinyInteger('status')->default('0');
            $table->text('comment')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->string('action', 50)->nullable();
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
        Schema::dropIfExists('salary_details');
    }
}
