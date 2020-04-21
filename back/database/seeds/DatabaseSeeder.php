<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeSeeder::class);
        $this->call(ModelSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(LogoSeeder::class);
        $this->call(LogoTypeSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(UserSeder::class);
    }
}
