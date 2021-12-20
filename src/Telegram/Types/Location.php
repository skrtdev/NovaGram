<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a point on the map.
*/
class Location extends Type{
    
    /** @var float Longitude as defined by sender */
    public float $longitude;

    /** @var float Latitude as defined by sender */
    public float $latitude;

    /** @var float|null The radius of uncertainty for the location, measured in meters; 0-1500 */
    public ?float $horizontal_accuracy = null;

    /** @var int|null Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only. */
    public ?int $live_period = null;

    /** @var int|null The direction in which user is moving, in degrees; 1-360. For active live locations only. */
    public ?int $heading = null;

    /** @var int|null Maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only. */
    public ?int $proximity_alert_radius = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->longitude = $array['longitude'];
        $this->latitude = $array['latitude'];
        $this->horizontal_accuracy = $array['horizontal_accuracy'] ?? null;
        $this->live_period = $array['live_period'] ?? null;
        $this->heading = $array['heading'] ?? null;
        $this->proximity_alert_radius = $array['proximity_alert_radius'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
