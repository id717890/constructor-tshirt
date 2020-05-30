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
        $this->call(DiscountSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(HomeSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(CatalogSeeder::class);
        $this->call(PromoCodeSeeder::class);
    }
}
