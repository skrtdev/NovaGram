<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a point on the map.
*/
class Location extends \Telegram\Location{

    use simpleProto;

    /** @var float Longitude as defined by sender */
    public float $longitude;

    /** @var float Latitude as defined by sender */
    public float $latitude;

    
}

?>
