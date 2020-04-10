<?php

use Illuminate\Database\Seeder;

class LogoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logo_sizes')->delete();

        DB::table('logo_sizes')->insert([
            'id'=>1,
            'name' => '100 мм.',
            'size' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('logo_sizes')->insert([
            'id'=>2,
            'name' => '300 мм.',
            'size' => 300,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('logo_types')->delete();

        DB::table('logo_types')->insert([
            'id'=>1,
            'name' => 'Флекс SISER 1 цв.',
            'logo_size_id' => 1,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('logo_types')->insert([
            'id'=>2,
            'name' => 'Флекс SISER 2 цв.',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
