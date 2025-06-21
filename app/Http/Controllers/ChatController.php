<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Events\NewVisitorMessage;
use Telegram\Bot\Laravel\Facades\Telegram;

class ChatController extends Controller
{
    public function send($visitor_id, $text)
    {

        // 1) Сохраняем
        $msg = ChatMessage::create([
            'visitor_id'           => $visitor_id,
            'from_visitor'         => true,
            'text'                 => $text,
        ]);

        // 2) Шлём в Telegram-группу
        $resp = Telegram::sendMessage([
            'chat_id'    => config('services.telegram.chat_id'),
            'text'       => "<b>User {$visitor_id}:</b> ".$text,
            'parse_mode' => 'HTML',
        ]);

        $msg->update(['telegram_message_id' => $resp->getMessageId()]);

        return response()->json(['ok' => true]);
    }

    public function setWebhook(){
        return Telegram::setWebhook(['url' => 'https://161.35.20.189/api/chat/webhook']);

    }
    public function webhook(Request $req)
    {
        $update = Telegram::getWebhookUpdates();
        info($update);
        $msgObj = $update->getMessage();
        if (! $msgObj || ! $msgObj->getReplyToMessage()) {
            return 'ok';
        }

        $replyToId = $msgObj->getReplyToMessage()->getMessageId();
        $text      = $msgObj->getText();

        // 3) Ищем оригинал
        $orig = ChatMessage::where('telegram_message_id', $replyToId)->first();
        if (! $orig) {
            return 'ok';
        }

        // 4) Сохраняем ответ менеджера
        $reply = ChatMessage::create([
            'visitor_id'   => $orig->visitor_id,
            'from_visitor' => false,
            'text'         => $text,
        ]);

        // 5) Бродкастим на канал visitor.{visitor_id}
        broadcast(new NewVisitorMessage($reply));

        return 'ok';
    }
}
