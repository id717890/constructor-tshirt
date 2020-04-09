<?php

use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->delete();

        DB::table('colors')->insert([
            'id'=>1,
            'name' => 'Бирюзовый',
            'model_id' => 1,
            'article'=>'100652.013',
            'image_front' => '88e88688bde40620b80079f7cc23290f.jpg',
            'image_back' => '88e88688bde40620b80079f7cc23290f.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('colors')->insert([
            'id'=>2,
            'name' => 'Красный',
            'model_id' => 1,
            'article'=>'100652.601',
            'image_front' => 'c0cbfef4a183576095bb6025b0133127.jpg',
            'image_back' => 'c0cbfef4a183576095bb6025b0133127.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('colors')->insert([
            'id'=>3,
            'name' => 'Салатовый',
            'model_id' => 1,
            'article'=>'100652.401',
            'image_front' => 'b77ccb40d22718853042d062f14732f3.jpg',
            'image_back' => 'b77ccb40d22718853042d062f14732f3.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
