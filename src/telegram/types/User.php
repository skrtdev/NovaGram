<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a Telegram user or bot.
*/
class User extends \Telegram\User{

    /** @var int Unique identifier for this user or bot */
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

    
}

?>
