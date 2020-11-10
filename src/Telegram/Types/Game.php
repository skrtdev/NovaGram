<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
*/
class Game extends \Telegram\Game{

    use simpleProto;

    /** @var string Title of the game */
    public string $title;

    /** @var string Description of the game */
    public string $description;

    /** @var stdClass Photo that will be displayed in the game message in chats. */
    public stdClass $photo;

    /** @var string|null Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters. */
    public ?string $text = null;

    /** @var stdClass|null Special entities that appear in text, such as usernames, URLs, bot commands, etc. */
    public ?stdClass $text_entities = null;

    /** @var Animation|null Animation that will be displayed in the game message in chats. Upload via BotFather */
    public ?Animation $animation = null;

    
}

?>
