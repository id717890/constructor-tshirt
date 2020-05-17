<?php

use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('models')->delete();

        DB::table('models')->insert([
            'id'=>1,
            'name' => 'Футболка EMOTION',
            'type_id' => 1,
            'order'=> 3,
            'image' => '88e88688bde40620b80079f7cc23290f.jpg',
            'description' => 'Футболка с круглым вырезом из материала с гофрированной поверхностью формы V на груди и вышитым логотипом. В этой форме играют такие команды, как «Суонси Сити».',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('models')->insert([
            'id'=>2,
            'name' => 'Футболка GRADA LONG SLEEVEN',
            'type_id' => 1,
            'order'=> 2,
            'image' => 'c1e67bca39f2ba306af501aa9a8e4a80.jpg',
            'description' => 'Описание футболки GRADA LONG SLEEVEN',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('models')->insert([
            'id'=>3,
            'name' => 'Футболка SPIKE lady',
            'type_id' => 2,
            'order'=> 1,
            'image' => '58425abdea3a36b0b0df76e719078a64.jpg',
            'description' => 'Описание футболки SPIKE lady',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
