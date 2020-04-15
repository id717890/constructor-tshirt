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

        DB::table('colors')->insert([
            'id'=>4,
            'name' => 'Белый',
            'model_id' => 2,
            'article'=>'100681.200',
            'image_front' => 'c1e67bca39f2ba306af501aa9a8e4a80.jpg',
            'image_back' => 'c1e67bca39f2ba306af501aa9a8e4a80.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('colors')->insert([
            'id'=>5,
            'name' => 'Синий',
            'model_id' => 2,
            'article'=>'100681.702',
            'image_front' => '5cd2cc390c36967a8d8dfa9af4a8648b.jpg',
            'image_back' => '5cd2cc390c36967a8d8dfa9af4a8648b.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('colors')->insert([
            'id'=>6,
            'name' => 'Фиолетовый',
            'model_id' => 2,
            'article'=>'100681.552',
            'image_front' => '22eca4eec574dac0a86ad2ffa2ab037e.jpg',
            'image_back' => '22eca4eec574dac0a86ad2ffa2ab037e.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('colors')->insert([
            'id'=>7,
            'name' => 'Черный',
            'model_id' => 2,
            'article'=>'100681.102',
            'image_front' => 'd756cd018a3a150db1af8ef55293c4a9.jpg',
            'image_back' => 'd756cd018a3a150db1af8ef55293c4a9.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('colors')->insert([
            'id'=>8,
            'name' => 'Белый',
            'model_id' => 3,
            'article'=>'900240.203',
            'image_front' => '58425abdea3a36b0b0df76e719078a64.jpg',
            'image_back' => '58425abdea3a36b0b0df76e719078a64.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('colors')->insert([
            'id'=>9,
            'name' => 'Розовый',
            'model_id' => 3,
            'article'=>'900240.510',
            'image_front' => 'f58dd55a4b8fb5b6b1cecf9f8c79799a.jpg',
            'image_back' => 'f58dd55a4b8fb5b6b1cecf9f8c79799a.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('colors')->insert([
            'id'=>10,
            'name' => 'Желтый',
            'model_id' => 3,
            'article'=>'900240.901',
            'image_front' => '62881c3ea4dea2a9aa0126870b014f32.jpg',
            'image_back' => '62881c3ea4dea2a9aa0126870b014f32.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('colors')->insert([
            'id'=>11,
            'name' => 'Фиолетовый',
            'model_id' => 3,
            'article'=>'900240.700',
            'image_front' => '881425e4ecfeb41b944e7aa0880efa6b.jpg',
            'image_back' => '881425e4ecfeb41b944e7aa0880efa6b.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('colors')->insert([
            'id'=>12,
            'name' => 'Черный',
            'model_id' => 3,
            'article'=>'900240.332',
            'image_front' => 'e1b8a60d889836d1af091a238607ce0b.jpg',
            'image_back' => 'e1b8a60d889836d1af091a238607ce0b.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
