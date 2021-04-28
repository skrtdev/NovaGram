<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results.
*/
class InlineQuery extends \Telegram\InlineQuery{

    use simpleProto;

    /** @var string Unique identifier for this query */
    public string $id;

    /** @var User Sender */
    public User $from;

    /** @var string Text of the query (up to 256 characters) */
    public string $query;

    /** @var string Offset of the results to be returned, can be controlled by the bot */
    public string $offset;

    /** @var string|null Type of the chat, from which the inline query was sent. Can be either “sender” for a private chat with the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for requests sent from official clients and most third-party clients, unless the request was sent from a secret chat */
    public ?string $chat_type = null;

    /** @var Location|null Sender location, only for bots that request user location */
    public ?Location $location = null;

    
}

?>
