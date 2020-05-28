<?php

use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogs')->delete();

//        for ($i = 1; $i <= 3; $i++) {
            DB::table('catalogs')->insert([
                'name' => 'TEAMWEAR Collection 2020',
                'image' => 'catalog-j1.jpg',
                'file' => 'catalog-1.txt',
                'ext' => 'txt',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);

            DB::table('catalogs')->insert([
                'name' => 'RUNNING 2020',
                'image' => 'catalog-j2.jpg',
                'file' => 'catalog-2.txt',
                'ext' => 'txt',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);

            DB::table('catalogs')->insert([
                'name' => 'RUGBY 2020',
                'image' => 'catalog-j3.jpg',
                'file' => 'catalog-3.txt',
                'ext' => 'txt',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
//        }
    }
}
