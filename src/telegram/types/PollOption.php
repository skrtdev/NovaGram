<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object contains information about one answer option in a poll.
*/
class PollOption extends \Telegram\PollOption{

    /** @var string Option text, 1-100 characters */
    public string $text;

    /** @var int Number of users that voted for this option */
    public int $voter_count;

    
}

?>
