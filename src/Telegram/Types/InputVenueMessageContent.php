<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents the content of a venue message to be sent as the result of an inline query.
*/
class InputVenueMessageContent extends Type{
    
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

    /** @var string|null Google Places identifier of the venue */
    public ?string $google_place_id = null;

    /** @var string|null Google Places type of the venue. (See supported types.) */
    public ?string $google_place_type = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->latitude = $array['latitude'];
        $this->longitude = $array['longitude'];
        $this->title = $array['title'];
        $this->address = $array['address'];
        $this->foursquare_id = $array['foursquare_id'] ?? null;
        $this->foursquare_type = $array['foursquare_type'] ?? null;
        $this->google_place_id = $array['google_place_id'] ?? null;
        $this->google_place_type = $array['google_place_type'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
