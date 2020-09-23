<?php

namespace skrtdev\Telegram;

use \stdClass;

class Poll extends \Telegram\Poll{

   public string $id;
   public string $question;
   public stdClass $options;
   public int $total_voter_count;
   public bool $is_closed;
   public bool $is_anonymous;
   public string $type;
   public bool $allows_multiple_answers;
   public ?int $correct_option_id;
   public ?string $explanation;
   public ?stdClass $explanation_entities;
   public ?int $open_period;
   public ?int $close_date;

}

?>