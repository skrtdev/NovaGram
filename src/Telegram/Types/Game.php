<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
*/
class Game extends Type{
    
    /** @var string Title of the game */
    public string $title;

    /** @var string Description of the game */
    public string $description;

    /** @var ObjectsList Photo that will be displayed in the game message in chats. */
    public ObjectsList $photo;

    /** @var string|null Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters. */
    public ?string $text = null;

    /** @var ObjectsList|null Special entities that appear in text, such as usernames, URLs, bot commands, etc. */
    public ?ObjectsList $text_entities = null;

    /** @var Animation|null Animation that will be displayed in the game message in chats. Upload via BotFather */
    public ?Animation $animation = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->title = $array['title'];
        $this->description = $array['description'];
        $this->photo = new ObjectsList(iterate($array['photo'], fn($item) => new PhotoSize($item, $Bot)));
        $this->text = $array['text'] ?? null;
        $this->text_entities = isset($array['text_entities']) ? new ObjectsList(iterate($array['text_entities'], fn($item) => new MessageEntity($item, $Bot))) : null;
        $this->animation = isset($array['animation']) ? new Animation($array['animation'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
