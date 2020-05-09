<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();

        DB::table('pages')->insert([
            'id' => 1,
            'name' => 'about',
            'title' => 'Раздел о компании',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam facere dicta voluptas dolores tempora nobis! Doloremque ut, ea pariatur sapiente maiores nihil quo eaque iure, officia excepturi quae qui voluptas! Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam facere dicta voluptas dolores tempora nobis! Doloremque ut, ea pariatur sapiente maiores nihil quo eaque iure, officia excepturi quae qui voluptas! Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam facere dicta voluptas dolores tempora nobis! Doloremque ut, ea pariatur sapiente maiores nihil quo eaque iure, officia excepturi quae qui voluptas! Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam facere dicta voluptas dolores tempora nobis! Doloremque ut, ea pariatur sapiente maiores nihil quo eaque iure, officia excepturi quae qui voluptas!',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
