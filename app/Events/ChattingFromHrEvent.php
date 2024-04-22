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

class ChattingFromHrEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $text_message;
    public $room_id;
    public $applicant_id;
    public $from;
    public function __construct($text_message,$room_id,$applicant_id,$from)
    {
        $this->text_message = $text_message;     
        $this->room_id = $room_id;                    
        $this->applicant_id = $applicant_id;
        $this->from = $from;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Chatting-channel.' . $this->room_id . '.' . $this->applicant_id);
    }
    public function broadcastAs()
    {   
        return 'Chatting-event';
    }
    public function broadcastWith(){
        return [
            'text_message' => $this->text_message,
            'room_id' => $this->room_id,
            'applicant_id' => $this->applicant_id,
            'from' => $this->from
        ];
    }
}
