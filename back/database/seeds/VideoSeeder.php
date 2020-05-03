<?php

use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->delete();

//        for ($i = 1; $i <= 30; $i++) {
            DB::table('videos')->insert([
                'title' => 'Europe\'s borders and coronavirus - BBC News',
                'text' => '<iframe
                  width="100%"
                  height="315"
                  src="https://www.youtube.com/embed/DZZwZ5KEiI4"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
            DB::table('videos')->insert([
                'title' => 'Pixies - Where Is My Mind | Fight Club Theme | Piano Cover',
                'text' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/XxthmuqWF1Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
//        }


    }
}
