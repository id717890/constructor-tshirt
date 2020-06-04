<?php

use Illuminate\Database\Seeder;

class TableSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//        ['6XS', '5XS', '6XS-5XS', '4XS', '3XS', '4XS-3XS', '2XS', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '2XL-3XL', '4XL'];
        DB::table('table_sizes')->delete();

        DB::table('table_sizes')->insert([
            'size' => '6XS',
            'name1' => 'Дети',
            'age1' => '4',
            'rf1' => '30',
            'height1' => '100-108',
            'chest1' => '55-58',
            'waist1' => '54-55',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
