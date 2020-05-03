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
        $this->createListProposition();

        $this->createGridProposition();
    }

    private function createListProposition()
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
    }

    private function createGridProposition(): void
    {
        Proposition::create([
            'title' => 'Kies rollen voor bestuur',
            'is_open' => true,
            'type' => 'grid',
            'order' => 2,
        ])
            ->options()
            ->createMany([
                ['axis' => 'horizontal', 'option' => 'Voorzitter'],
                ['axis' => 'horizontal', 'option' => 'Secretaris'],
                ['axis' => 'horizontal', 'option' => 'Penningmeester'],
                ['axis' => 'horizontal', 'option' => 'Vice-Voorzitter'],
                ['axis' => 'horizontal', 'option' => 'Intern'],
                ['axis' => 'horizontal', 'option' => 'Extern'],
                ['axis' => 'vertical', 'option' => 'Wesley Klop'],
                ['axis' => 'vertical', 'option' => 'Peter Nijessen'],
                ['axis' => 'vertical', 'option' => 'Niels van Gijzen'],
                ['axis' => 'vertical', 'option' => 'Sander Laarhoven'],
                ['axis' => 'vertical', 'option' => 'Jason Kloor'],
            ]);
    }
}
