<?php

use App\VoteSystem\Models\Proposition;
use Illuminate\Database\Seeder;

class PropositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proposition::create([
            'title' => 'Is dit een goede app?',
            'is_open' => true,
            'type' => 'list',
            'order' => 1,
        ])
            ->options()
            ->createMany([['option' => 'Ja'], ['option' => 'Nee']]);

        Proposition::create([
            'title' => 'Kies rollen voor bestuur',
            'is_open' => false,
            'type' => 'grid',
            'order' => 2,
        ])
            ->options()
            ->createMany([
                ['vector' => 'horizontal', 'option' => 'Voorzitter'],
                ['vector' => 'vertical', 'option' => 'Wesley'],
            ]);
    }
}
