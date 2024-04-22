<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\applicant;

class AppliCantSendCv implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public $hr_id;
    public function __construct($message,$hr_id)
    {
        $this->message = $message;                         
        $this->hr_id = $hr_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('ApplicantSendCv-channel.' .$this->hr_id);
    }
    public function broadcastAs()
    {   
        return 'applicant-send-cv';
    }
    public function broadcastWith(){
        return [
            'message' => $this->message,
            'hr_id' => $this->hr_id
        ];
    }
}
