<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Contains information about why a request was unsuccessful.
*/
class ResponseParameters extends \Telegram\ResponseParameters{

    /** @var int|null The group has been migrated to a supergroup with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. */
    public ?int $migrate_to_chat_id = null;

    /** @var int|null In case of exceeding flood control, the number of seconds left to wait before the request can be repeated */
    public ?int $retry_after = null;

    
}

?>
