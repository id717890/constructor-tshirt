<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->delete();


        for ($i = 1; $i < 30; $i++) {
            DB::table('news')->insert([
                'title' => 'BA may not reopen at Gatwick once pandemic passes',
                'image' => 'news.png',
                'text' => '
                <p class="story-body__introduction">British Airways has told staff that its Gatwick airport operation may not reopen after the coronavirus pandemic passes.</p>
                <p>The admission came in a memo, written by the head of BA\'s Gatwick hub and seen by BBC News.</p>
                <p>BA\'s Gatwick operation, which is currently suspended, is roughly a fifth as big as its Heathrow hub.</p>
                <p>In a separate letter to pilots, BA said it cannot rule out suspending the rest of its Heathrow operation. </p>
                <p>In the memo to Gatwick\'s staff, the company says: "As you know, we suspended our Gatwick flying schedule at the start of April and there is no certainty as to when or if these services can or will return."</p>
                ',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);

            DB::table('news')->insert([
                'title' => 'Coronavirus: Trump says China wants him to lose re-election',
                'image' => 'news.jpg',
                'text' => '<p class="story-body__introduction">US President Donald Trump has said China "will do anything they can" to make him lose his re-election bid, stepping up his criticism of Beijing amid the coronavirus pandemic.</p>
<p>He said China should have let the world know about the contagion much sooner.</p>
<p>A spokesperson for China\'s foreign ministry has denied the allegations. </p>
<p>Geng Shuang said China saw the US election as an internal issue, and said he hoped US politicians would stop using China in their domestic politics.</p>
',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }

    }
}
