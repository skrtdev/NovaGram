<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that originated the query was attached to a message sent by the bot, the field message will be present. If the button was attached to a message sent via the bot (in inline mode), the field inline_message_id will be present. Exactly one of the fields data or game_short_name will be present.
*/
class CallbackQuery extends Type{
    
    /** @var string Unique identifier for this query */
    public string $id;

    /** @var User Sender */
    public User $from;

    /** @var Message|null Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old */
    public ?Message $message = null;

    /** @var string|null Identifier of the message sent via the bot in inline mode, that originated the query. */
    public ?string $inline_message_id = null;

    /** @var string Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games. */
    public string $chat_instance;

    /** @var string|null Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field. */
    public ?string $data = null;

    /** @var string|null Short name of a Game to be returned, serves as the unique identifier for the game */
    public ?string $game_short_name = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->from = new User($array['from'], $Bot);
        $this->message = isset($array['message']) ? new Message($array['message'], $Bot) : null;
        $this->inline_message_id = $array['inline_message_id'] ?? null;
        $this->chat_instance = $array['chat_instance'];
        $this->data = $array['data'] ?? null;
        $this->game_short_name = $array['game_short_name'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    public function answer($text = null, $show_alert = null, $url = null, int $cache_time = null, bool $json_payload = false): ?bool
    {
        if(is_array($text)){
            $json_payload = $show_alert ?? false;
            $params = $text;
        }
        else{
            if(is_array($show_alert)){
                $json_payload = $url ?? false;
                $params = ['text' => $text] + $show_alert;
            }
            else $params = ['text' => $text, 'show_alert' => $show_alert, 'url' => $url, 'cache_time' => $cache_time, 'json_payload' => $json_payload];
        }
        $params['callback_query_id'] ??= $this->id;
        return $this->Bot->answerCallbackQuery($params, $json_payload);
    }
}
