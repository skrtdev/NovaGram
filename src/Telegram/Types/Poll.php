<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object contains information about a poll.
*/
class Poll extends Type{
    
    /** @var string Unique poll identifier */
    public string $id;

    /** @var string Poll question, 1-300 characters */
    public string $question;

    /** @var ObjectsList List of poll options */
    public ObjectsList $options;

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

    /** @var ObjectsList|null Special entities like usernames, URLs, bot commands, etc. that appear in the explanation */
    public ?ObjectsList $explanation_entities = null;

    /** @var int|null Amount of time in seconds the poll will be active after creation */
    public ?int $open_period = null;

    /** @var int|null Point in time (Unix timestamp) when the poll will be automatically closed */
    public ?int $close_date = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->question = $array['question'];
        $this->options = new ObjectsList(iterate($array['options'], fn($item) => new PollOption($item, $Bot)));
        $this->total_voter_count = $array['total_voter_count'];
        $this->is_closed = $array['is_closed'];
        $this->is_anonymous = $array['is_anonymous'];
        $this->type = $array['type'];
        $this->allows_multiple_answers = $array['allows_multiple_answers'];
        $this->correct_option_id = $array['correct_option_id'] ?? null;
        $this->explanation = $array['explanation'] ?? null;
        $this->explanation_entities = isset($array['explanation_entities']) ? new ObjectsList(iterate($array['explanation_entities'], fn($item) => new MessageEntity($item, $Bot))) : null;
        $this->open_period = $array['open_period'] ?? null;
        $this->close_date = $array['close_date'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
