<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_permission')->truncate();

        $all_menu = DB::table('menus')->get();

        foreach ($all_menu as $key => $value) {
            DB::table('menu_permission')->insert([
                'role_id' => 1,
                'menu_id' => $value->id,
            ]);
        }
    }
}
