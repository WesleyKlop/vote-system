<?php

namespace Tests\Feature\Voter;

use App\Events\PropositionChange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
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
        Event::fake();

        $voter = $this->voter();
        $proposition = $this->createProposition();

        Event::assertDispatched(PropositionChange::class);

        $response = $this->actingAs($voter, 'web-voter')->get(
            route('proposition.index')
        );

        $response
            ->assertViewIs('views.voter.show')
            ->assertSee($proposition->title)
            ->assertOk();
    }
}
