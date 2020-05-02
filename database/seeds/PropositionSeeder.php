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
            'title' => 'Jouw mening over deze app',
            'is_open' => true,
            'type' => 'list',
            'order' => 1,
        ])
            ->options()
            ->createMany([
                [
                    'axis' => 'horizontal',
                    'option' => 'Wat vindt je van deze app?',
                ],
                ['option' => 'Ja'],
                ['option' => 'Nee'],
            ]);

        Proposition::create([
            'title' => 'Kies rollen voor bestuur',
            'is_open' => true,
            'type' => 'grid',
            'order' => 2,
        ])
            ->options()
            ->createMany([
                ['axis' => 'horizontal', 'option' => 'Voorzitter'],
                ['axis' => 'vertical', 'option' => 'Wesley'],
            ]);
    }
}
