<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\WidgetAction;

class WidgetChange implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $widgets;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $data = [];
        $widgets = WidgetAction::all() ?? [];
        foreach ($widgets as $k => $widget) {
            $data[$k] = $widget;
            $data[$k]['data'] = json_decode($data[$k]['data'], true);
        }
        $this->widgets = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('widgets');
    }
    
    public function broadcastAs()
    {
        return 'widget-change';
    }
}
