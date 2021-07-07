<?php

namespace Database\Seeders;

use App\Models\Proposition;
use App\Models\PropositionOption;
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
            'title' => 'Your opinion of this application',
            'is_open' => true,
            'type' => 'list',
            'order' => 1,
        ])
            ->options()
            ->createMany([
                [
                    'axis' => 'horizontal',
                    'option' => 'What do you think of this app?',
                ],
                ['option' => 'Very cool'],
                ['option' => 'Super awesome'],
            ]);
    }

    private function createGridProposition(): void
    {
        Proposition::factory()
            ->has(PropositionOption::factory()
                ->people()
                ->vertical()
                ->count(5),
                'options')
            ->create([
                'title' => 'Choose which members should fill which role',
                'is_open' => true,
                'type' => 'grid',
                'order' => 2,
            ])
            ->options()
            ->createMany([
                ['axis' => 'horizontal', 'option' => 'Chairman'],
                ['axis' => 'horizontal', 'option' => 'Secretary'],
                ['axis' => 'horizontal', 'option' => 'Treasurer'],
                ['axis' => 'horizontal', 'option' => 'Vice-chairman'],
                ['axis' => 'horizontal', 'option' => 'Internal affairs'],
                ['axis' => 'horizontal', 'option' => 'External affairs'],
            ]);
    }
}
