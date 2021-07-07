<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class VoterVoted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public float $timestamp;

    public function __construct(public Collection $results)
    {
        $this->timestamp = microtime(true);
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('results');
    }
}
