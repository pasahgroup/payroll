<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('role')->truncate();
        DB::table('role')->insert(
            [
                ['role_name' => 'Super Admin', 'created_at' => $time, 'updated_at' => $time],
            ]

        );
    }
}
