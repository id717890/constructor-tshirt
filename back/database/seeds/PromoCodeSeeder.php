<?php

use Illuminate\Database\Seeder;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promocodes')->delete();

        DB::table('promocodes')->insert([
            'name' => 'Промокод Тестовый',
            'code'=>'QWE',
            'discount'=>50,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('promocodes')->insert([
            'name' => 'ЕЩЕ промокод',
            'code'=>'WWW',
            'discount'=>25,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
