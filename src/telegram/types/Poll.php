<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object contains information about a poll.
*/
class Poll extends \Telegram\Poll{

    /** @var string Unique poll identifier */
    public string $id;

    /** @var string Poll question, 1-255 characters */
    public string $question;

    /** @var stdClass List of poll options */
    public stdClass $options;

    /** @var int Total number of users that voted in the poll */
    public int $total_voter_count;

    /** @var bool True, if the poll is closed */
    public bool $is_closed;

    /** @var bool True, if the poll is anonymous */
    public bool $is_anonymous;

    /** @var string Poll type, currently can be “regular” or “quiz” */
    public string $type;

    /** @var bool True, if the poll allows multiple answers */
    public bool $allows_multiple_answers;

    /** @var int|null 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot. */
    public ?int $correct_option_id = null;

    /** @var string|null Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters */
    public ?string $explanation = null;

    /** @var stdClass|null Special entities like usernames, URLs, bot commands, etc. that appear in the explanation */
    public ?stdClass $explanation_entities = null;

    /** @var int|null Amount of time in seconds the poll will be active after creation */
    public ?int $open_period = null;

    /** @var int|null Point in time (Unix timestamp) when the poll will be automatically closed */
    public ?int $close_date = null;

    
}

?>
