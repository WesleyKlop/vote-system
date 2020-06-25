<?php

namespace Tests\Feature\Voter;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesPropositions;
use Tests\TestCase;
use Tests\UsesVoters;

class PropositionTest extends TestCase
{
    use RefreshDatabase;
    use UsesVoters;
    use CreatesPropositions;

    public function testPropositionPageUnreachableWhenGuest(): void
    {
        $response = $this->get(route('proposition.index'));

        $response->assertRedirect(route('voter.index'));
    }

    public function testCanVisitPropositionPage(): void
    {
        $voter = $this->voter();
        $proposition = $this->createProposition();

        $response = $this->actingAs($voter, 'voter')->get(
            route('proposition.index')
        );

        $response
            ->assertViewIs('views.voter.show')
            ->assertSeeText($proposition->title)
            ->assertOk();
    }
}
