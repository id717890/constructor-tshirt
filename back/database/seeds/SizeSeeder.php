<?php

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->delete();

        DB::table('sizes')->insert([
            'id' => 1,
            'size' => 'XS',
            'color_id' => 1,
            'price' => 100,
            'count' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'id' => 2,
            'size' => 'S',
            'color_id' => 1,
            'price' => 200,
            'count' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'id' => 3,
            'size' => 'M',
            'color_id' => 1,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
