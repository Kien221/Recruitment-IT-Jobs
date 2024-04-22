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

class HrAcceptCv implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public $applicant_id;
    public function __construct($message,$applicant_id)
    {
        $this->message = $message;                         
        $this->applicant_id = $applicant_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Recruitment-channel.' .$this->applicant_id);
    }
    public function broadcastAs()
    {   
        return 'hr-accept-applicantcv';
    }
    public function broadcastWith(){
        return [
            'message' => $this->message,
            'applicant_id' => $this->applicant_id
        ];
    }
}
