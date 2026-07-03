<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewInquiryBroadcast implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $inquiryData;

    public function __construct(array $inquiryData)
    {
        $this->inquiryData = $inquiryData;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('makkah-gateway-alerts'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'new-inquiry';
    }
}
