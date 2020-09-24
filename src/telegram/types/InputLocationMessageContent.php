<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
*/
class InputLocationMessageContent extends \Telegram\InputLocationMessageContent{

   /** @var float Latitude of the venue in degrees */
   public float $latitude;

   /** @var float Longitude of the venue in degrees */
   public float $longitude;

   /** @var string Name of the venue */
   public string $title;

   /** @var string Address of the venue */
   public string $address;

   /** @var string|null Foursquare identifier of the venue, if known */
   public ?string $foursquare_id = null;

   /** @var string|null Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.) */
   public ?string $foursquare_type = null;


}

?>
