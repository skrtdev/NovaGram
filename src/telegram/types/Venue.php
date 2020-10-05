<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a venue.
*/
class Venue extends \Telegram\Venue{

    /** @var Location Venue location */
    public Location $location;

    /** @var string Name of the venue */
    public string $title;

    /** @var string Address of the venue */
    public string $address;

    /** @var string|null Foursquare identifier of the venue */
    public ?string $foursquare_id = null;

    /** @var string|null Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.) */
    public ?string $foursquare_type = null;

    
}

?>
