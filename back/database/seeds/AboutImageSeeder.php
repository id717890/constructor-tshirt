<?php

use Illuminate\Database\Seeder;

class AboutImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about_images')->delete();

//        for ($i = 1; $i <= 30; $i++) {
//            DB::table('about_images')->insert([
//                'name' => 'TEAMWEAR Collection 2020',
//                'image' => 'about-image-{F4263EA4-9405-4378-9611-8292A1AB6D3A}.jpg',
//                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
//                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
//            ]);
//        }

    }
}
