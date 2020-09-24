<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents an answer of a user in a non-anonymous poll.
*/
class PollAnswer extends \Telegram\PollAnswer{

   /** @var string Unique poll identifier */
   public string $poll_id;

   /** @var User The user, who changed the answer to the poll */
   public User $user;

   /** @var stdClass 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote. */
   public stdClass $option_ids;


}

?>
