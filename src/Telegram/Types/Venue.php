<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a venue.
*/
class Venue extends \Telegram\Venue{

    use simpleProto;

    /** @var Location Venue location. Can't be a live location */
    public Location $location;

    /** @var string Name of the venue */
    public string $title;

    /** @var string Address of the venue */
    public string $address;

    /** @var string|null Foursquare identifier of the venue */
    public ?string $foursquare_id = null;

    /** @var string|null Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.) */
    public ?string $foursquare_type = null;

    /** @var string|null Google Places identifier of the venue */
    public ?string $google_place_id = null;

    /** @var string|null Google Places type of the venue. (See supported types.) */
    public ?string $google_place_type = null;

    
}

?>
