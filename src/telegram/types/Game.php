<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
*/
class Game extends \Telegram\Game{

    use simpleProto;

    /** @var int Yes */
    public int $user_id;

    /** @var int Yes */
    public int $score;

    /** @var bool Optional */
    public bool $force;

    /** @var bool Optional */
    public bool $disable_edit_message;

    /** @var int Optional */
    public int $chat_id;

    /** @var int Optional */
    public int $message_id;

    /** @var string Optional */
    public string $inline_message_id;

    
}

?>
