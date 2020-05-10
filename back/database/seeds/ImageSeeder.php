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
        DB::table('albums')->delete();

        DB::table('albums')->insert([
            'id' => 1,
            'name' => 'Альбом №1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('albums')->insert([
            'id' => 2,
            'name' => 'Альбом №2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('albums')->insert([
            'id' => 3,
            'name' => 'Альбом №3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('albums')->insert([
            'id' => 4,
            'name' => 'Альбом №4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

//        for ($i = 1; $i <= 7; $i++) {
        DB::table('images')->insert([
            'title' => 'Пример изображение 1',
            'image' => 'image-lighthouse.jpg',
            'album_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('images')->insert([
            'title' => 'Пример изображение  2',
            'image' => 'image-tulips.jpg',
            'album_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('images')->insert([
            'title' => 'Пример изображение 1',
            'image' => 'image-tulips.jpg',
            'album_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

//        }
    }
}
