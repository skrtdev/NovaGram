<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
*/
class InputTextMessageContent extends \Telegram\InputTextMessageContent{

   /** @var float Latitude of the location in degrees */
   public float $latitude;

   /** @var float Longitude of the location in degrees */
   public float $longitude;

   /** @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400. */
   public ?int $live_period = null;


}

?>
