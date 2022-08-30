<?php

namespace App\Events;

use App\Models\Notification;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddNotifications implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $notification;


    /**
     * Message details
     *
     * @var Notification
     */
    public function __construct(Notification $notification)
    {
        //


        $this->notification  =$notification;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('AddNotifications'.$this->notification->user->admin);

        //return ['AddNotifications'];
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->notification->message,
            'url' => $this->notification->url,
            'created_at' => $this->notification->created_at,
            'user' => [
                'id' => $this->notification->user->id,
                'name' => $this->notification->user->name,
                'image'=> $this->notification->user->image,
            ]
        ];
    }
}
