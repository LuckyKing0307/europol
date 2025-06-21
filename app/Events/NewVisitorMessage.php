<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\ChatMessage;

class NewVisitorMessage implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public ChatMessage $message;

    public function __construct(ChatMessage $msg)
    {
        $this->message = $msg;
    }

    public function broadcastOn()
    {
        return new Channel('visitor.'.$this->message->visitor_id);
    }

    public function broadcastWith()
    {
        return [
            'text'        => $this->message->text,
            'fromVisitor' => $this->message->from_visitor,
            'created_at'  => $this->message->created_at->toDateTimeString(),
        ];
    }
}
