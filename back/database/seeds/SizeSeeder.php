<?php

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->delete();

        DB::table('sizes')->insert([
            'id' => 1,
            'size' => 'S',
            'color_id' => 1,
            'price' => 100,
            'count' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'id' => 2,
            'size' => 'M',
            'color_id' => 1,
            'price' => 200,
            'count' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'id' => 3,
            'size' => 'L',
            'color_id' => 1,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'id' => 4,
            'size' => 'XL',
            'color_id' => 1,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'id' => 5,
            'size' => 'XXL',
            'color_id' => 1,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);


        DB::table('sizes')->insert([
            'size' => 'S',
            'color_id' => 2,
            'price' => 100,
            'count' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'M',
            'color_id' => 2,
            'price' => 200,
            'count' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'L',
            'color_id' => 2,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'XL',
            'color_id' => 2,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'XXL',
            'color_id' => 2,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);


        DB::table('sizes')->insert([
            'size' => 'S',
            'color_id' => 3,
            'price' => 100,
            'count' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'M',
            'color_id' => 3,
            'price' => 200,
            'count' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'L',
            'color_id' => 3,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'XL',
            'color_id' => 3,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'XXL',
            'color_id' => 3,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);



        DB::table('sizes')->insert([
            'size' => '6XS-5XS',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => '4XS-3XS',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => '2XS',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'XS',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'S',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'M',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'L',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => 'XL',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('sizes')->insert([
            'size' => '2ХL-3ХL',
            'color_id' => 4,
            'price' => 300,
            'count' => 22,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
