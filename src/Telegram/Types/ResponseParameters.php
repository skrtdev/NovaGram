<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Contains information about why a request was unsuccessful.
*/
class ResponseParameters extends Type{
    
    /** @var int|null The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier. */
    public ?int $migrate_to_chat_id = null;

    /** @var int|null In case of exceeding flood control, the number of seconds left to wait before the request can be repeated */
    public ?int $retry_after = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->migrate_to_chat_id = $array['migrate_to_chat_id'] ?? null;
        $this->retry_after = $array['retry_after'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
