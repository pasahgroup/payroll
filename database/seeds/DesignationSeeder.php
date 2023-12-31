<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('designation')->truncate();
        DB::table('designation')->insert(
            [
                ['designation_name' => 'Director', 'created_at' => $time, 'updated_at' => $time],

            ]

        );
    }
}
