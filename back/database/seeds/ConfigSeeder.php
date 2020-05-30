<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->delete();

        DB::table('configs')->insert([
            'key' => 'home_slider_height',
            'value' => '300',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('configs')->insert([
            'key' => 'home_slide_discount',
            'value' => 'home-discount-1.jpg',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('configs')->insert([
            'key' => 'home_block4',
            'value' => '{"button1Text":"Перейти к конструктору1","button1Url":"/constructor","button2Text":"Смотреть видеоролик","button2Iframe":"<iframe width=\"100%\" height=\"500\" src=\"https://www.youtube.com/embed/B0KbTbKmqCU\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>","image":"home-block4-{32ACAE69-E8F4-4C43-855D-57359215D2B4}.jpg","title":"Создай свою форму!","text":"<h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima ullam, expedita aliquid eum, iure cumque cum laudantium consectetur itaque</h1>"}',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

    }
}
