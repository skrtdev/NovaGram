<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the location.
*/
class InlineQueryResultLocation extends Type{
    
    protected string $_ = 'InlineQueryResultLocation';

    /** @var string Type of the result, must be location */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 Bytes */
    public string $id;

    /** @var float Location latitude in degrees */
    public float $latitude;

    /** @var float Location longitude in degrees */
    public float $longitude;

    /** @var string Location title */
    public string $title;

    /** @var float|null The radius of uncertainty for the location, measured in meters; 0-1500 */
    public ?float $horizontal_accuracy = null;

    /** @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400. */
    public ?int $live_period = null;

    /** @var int|null For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified. */
    public ?int $heading = null;

    /** @var int|null For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified. */
    public ?int $proximity_alert_radius = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the location */
    public ?InputMessageContent $input_message_content = null;

    /** @var string|null Url of the thumbnail for the result */
    public ?string $thumb_url = null;

    /** @var int|null Thumbnail width */
    public ?int $thumb_width = null;

    /** @var int|null Thumbnail height */
    public ?int $thumb_height = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->id = $array['id'];
        $this->latitude = $array['latitude'];
        $this->longitude = $array['longitude'];
        $this->title = $array['title'];
        $this->horizontal_accuracy = $array['horizontal_accuracy'] ?? null;
        $this->live_period = $array['live_period'] ?? null;
        $this->heading = $array['heading'] ?? null;
        $this->proximity_alert_radius = $array['proximity_alert_radius'] ?? null;
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        $this->input_message_content = isset($array['input_message_content']) ? new InputMessageContent($array['input_message_content'], $Bot) : null;
        $this->thumb_url = $array['thumb_url'] ?? null;
        $this->thumb_width = $array['thumb_width'] ?? null;
        $this->thumb_height = $array['thumb_height'] ?? null;
        parent::__construct($array, $Bot);
   }
    
}
