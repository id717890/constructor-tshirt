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
            'description' => 'Флекс SISER (Италия), в один цвет. Без ограничения по количеству',
            'logo_size_id' => 1,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('logo_types')->insert([
            'id'=>2,
            'name' => 'Флекс SISER 2 цв.',
            'description' => 'Флекс SISER (Италия), в два цвета. Без ограничения по количеству',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>3,
            'name' => 'Флекс SISER 3 цв.',
            'description' => 'Флекс SISER (Италия), в три цвета. Без ограничения по количеству',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>4,
            'name' => 'Трансформер',
            'description' => 'Макс. восемь цветов. Мин. 50 логотипов.',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>5,
            'name' => 'Шеврон сублимационный AVRORA',
            'description' => 'Без ограничения по цвету и кол-ву',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>6,
            'name' => 'Шеврон жаккардовый',
            'description' => 'Макс. восемь цветов. Мин. 250 логотипов.',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>7,
            'name' => 'Вышивка',
            'description' => 'Макс. восемь цветов. Мин. 50 логотипов.',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>8,
            'name' => 'Сублимация',
            'description' => 'Только белый полиэстер, без ограничения по цвету и количеству',
            'logo_size_id' => 1,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);


        DB::table('logo_types')->insert([
            'id'=>9,
            'name' => 'Флекс SISER 1 цв.',
            'description' => 'Флекс SISER (Италия), в один цвет. Без ограничения по количеству',
            'logo_size_id' => 2,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('logo_types')->insert([
            'id'=>10,
            'name' => 'Флекс SISER 2 цв.',
            'description' => 'Флекс SISER (Италия), в два цвета. Без ограничения по количеству',
            'logo_size_id' => 2,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>11,
            'name' => 'Флекс SISER 3 цв.',
            'description' => 'Флекс SISER (Италия), в три цвета. Без ограничения по количеству',
            'logo_size_id' => 2,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>12,
            'name' => 'Трансформер',
            'description' => 'Макс. восемь цветов. Мин. 50 логотипов.',
            'logo_size_id' => 2,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>13,
            'name' => 'Шеврон сублимационный AVRORA',
            'description' => 'Без ограничения по цвету и кол-ву',
            'logo_size_id' => 2,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>14,
            'name' => 'Шеврон жаккардовый',
            'description' => 'Макс. восемь цветов. Мин. 250 логотипов.',
            'logo_size_id' => 2,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>15,
            'name' => 'Вышивка',
            'description' => 'Макс. восемь цветов. Мин. 50 логотипов.',
            'logo_size_id' => 2,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('logo_types')->insert([
            'id'=>16,
            'name' => 'Сублимация',
            'description' => 'Только белый полиэстер, без ограничения по цвету и количеству',
            'logo_size_id' => 2,
            'price' => 120,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('number_sizes')->delete();

        DB::table('number_sizes')->insert([
            'id'=>1,
            'name' => '40 мм.',
            'size' => 40,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('number_sizes')->insert([
            'id'=>2,
            'name' => '100 мм.',
            'size' => 100,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('number_sizes')->insert([
            'id'=>3,
            'name' => '230 мм.',
            'size' => 230,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('text_sizes')->delete();

        DB::table('text_sizes')->insert([
            'id'=>1,
            'name' => '100 мм.',
            'size' => 100,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        DB::table('text_sizes')->insert([
            'id'=>2,
            'name' => '300 мм.',
            'size' => 300,
            'price' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
