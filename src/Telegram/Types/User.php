<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a Telegram user or bot.
*/
class User extends Type{
    
    use \skrtdev\NovaGram\dc;

    protected string $_ = 'User';

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

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->is_bot = $array['is_bot'];
        $this->first_name = $array['first_name'];
        $this->last_name = $array['last_name'] ?? null;
        $this->username = $array['username'] ?? null;
        $this->language_code = $array['language_code'] ?? null;
        $this->can_join_groups = $array['can_join_groups'] ?? null;
        $this->can_read_all_group_messages = $array['can_read_all_group_messages'] ?? null;
        $this->supports_inline_queries = $array['supports_inline_queries'] ?? null;
        parent::__construct($array, $Bot);
   }

    public function getMention(): string
    {
        return "<a href=\"tg://user?id={$this->id}\">". htmlspecialchars($this->first_name. ( isset($this->last_name) ? " {$this->last_name}" : '' )) ."</a>";
    }
}

