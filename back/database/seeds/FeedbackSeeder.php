<?php

use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->delete();

        DB::table('feedbacks')->insert([
            'text' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur totam pariatur fugit, deleniti est voluptatem id expedita asperiores iusto eos iste distinctio dolore quidem quasi voluptas quo blanditiis, enim minus.',
            'rating' => 3,
            'show' => true,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('feedbacks')->insert([
            'text' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur totam pariatur fugit, deleniti est voluptatem id expedita asperiores iusto eos iste distinctio dolore quidem quasi voluptas quo blanditiis, enim minus.',
            'rating' => 5,
            'show' => true,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('feedbacks')->insert([
            'text' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur totam pariatur fugit, deleniti est voluptatem id expedita asperiores iusto eos iste distinctio dolore quidem quasi voluptas quo blanditiis, enim minus. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur totam pariatur fugit, deleniti est voluptatem id expedita asperiores iusto eos iste distinctio dolore quidem quasi voluptas quo blanditiis, enim minus.',
            'rating' => 4,
            'show' => true,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('feedbacks')->insert([
            'text' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur totam pariatur fugit, deleniti est voluptatem id expedita asperiores iusto eos iste distinctio dolore quidem quasi voluptas quo blanditiis, enim minus.',
            'rating' => 4,
            'show' => false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
