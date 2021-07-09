<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
*/
class InputLocationMessageContent extends Type{
    
    /** @var float Latitude of the location in degrees */
    public float $latitude;

    /** @var float Longitude of the location in degrees */
    public float $longitude;

    /** @var float|null The radius of uncertainty for the location, measured in meters; 0-1500 */
    public ?float $horizontal_accuracy = null;

    /** @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400. */
    public ?int $live_period = null;

    /** @var int|null For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified. */
    public ?int $heading = null;

    /** @var int|null For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified. */
    public ?int $proximity_alert_radius = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->latitude = $array['latitude'];
        $this->longitude = $array['longitude'];
        $this->horizontal_accuracy = $array['horizontal_accuracy'] ?? null;
        $this->live_period = $array['live_period'] ?? null;
        $this->heading = $array['heading'] ?? null;
        $this->proximity_alert_radius = $array['proximity_alert_radius'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
