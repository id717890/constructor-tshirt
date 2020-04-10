<?php

use Illuminate\Database\Seeder;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logos')->delete();

        DB::table('logos')->insert([
            'id'=>1,
            'name' => 'Логотип №1',
            'image' => 'futbolist.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('logos')->insert([
            'id'=>2,
            'name' => 'Логотип №2',
            'image' => 'soccer-ball-design_1818070.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logos')->insert([
            'id'=>3,
            'name' => 'Логотип №3',
            'image' => 'logo1x1.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
