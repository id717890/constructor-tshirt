<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->delete();

//        for ($i = 1; $i <= 7; $i++) {
            DB::table('images')->insert([
                'title' => 'Пример изображение 1',
                'image' => 'image-tulips.jpg',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
            DB::table('images')->insert([
                'title' => 'Пример изображение  2',
                'image' => 'image-lighthouse.jpg',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
//        }
    }
}
