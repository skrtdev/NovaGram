<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;
use skrtdev\NovaGram\Bot;

/**
 * This object represents a Telegram user or bot.
*/
class User extends \Telegram\User{

    use simpleProto;

    /** @var int Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. */
    public int $id;

    /** @var bool True, if this user is a bot */
    public bool $is_bot;

    /** @var string User's or bot's first name */
    public string $first_name;

    /** @var string|null User's or bot's last name */
    public ?string $last_name = null;

    /** @var string|null User's or bot's username */
    public ?string $username = null;

    /** @var string|null IETF language tag of the user's language */
    public ?string $language_code = null;

    /** @var bool|null True, if the bot can be invited to groups. Returned only in getMe. */
    public ?bool $can_join_groups = null;

    /** @var bool|null True, if privacy mode is disabled for the bot. Returned only in getMe. */
    public ?bool $can_read_all_group_messages = null;

    /** @var bool|null True, if the bot supports inline queries. Returned only in getMe. */
    public ?bool $supports_inline_queries = null;

    public function __construct(array $json, Bot $Bot = null){
        parent::__construct($json, $Bot);

        if($Bot->hasDatabase()){
            $Bot->getDatabase()->insertUser($this);
        }
    }

    public function getMention(): string
    {
        return "<a href=\"tg://user?id={$this->id}\">". htmlspecialchars($this->first_name. ( isset($this->last_name) ? " {$this->last_name}" : '' )) ."</a>";
    }
}

?>
