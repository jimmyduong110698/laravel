<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewProduct implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $array_user = array();
    public function __construct($array_user)
    {
        $this->array_user = $array_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['comment'];
    }

    public function broadcastAs()
    {
        return 'new_product';
    }
}
