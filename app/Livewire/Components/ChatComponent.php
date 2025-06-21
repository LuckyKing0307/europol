<?php

namespace App\Livewire\Components;

use App\Http\Controllers\ChatController;
use App\Models\ChatMessage;
use Livewire\Component;
use Telegram\Bot\Laravel\Facades\Telegram;

class ChatComponent extends Component
{
    public string $visitorId;
    public string $newText = '';
    public array $messages = [];

    public function mount()
    {
        // либо session_id(), либо свой UUID
        $this->visitorId = session()->getId();

        // можно при монтировании загрузить прошлые сообщения
        $this->messages = ChatMessage::where('visitor_id', $this->visitorId)
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'text' => $m->text,
                'fromVisitor' => $m->from_visitor,
                'time' => $m->created_at->toDateTimeString(),
            ])->toArray();
    }

    protected function getListeners()
    {
        return [
            "echo:visitor.{$this->visitorId},NewVisitorMessage" => 'handleNewMessage',
        ];
    }

    public function sendMessage()
    {
        $controller = app(ChatController::class);
        $controller->send($this->visitorId, $this->newText);

        $this->messages[] = [
            'text'       => $this->newText,
            'fromVisitor'=> true,
            'time'       => now()->toDateTimeString(),
        ];

        $this->newText = '';
    }

    public function handleNewMessage($payload)
    {
        $this->messages[] = [
            'text' => $payload['text'],
            'fromVisitor' => $payload['fromVisitor'],
            'time' => $payload['created_at'],
        ];
    }

    public function render()
    {
        return view('livewire.components.chat-component');
    }
}
