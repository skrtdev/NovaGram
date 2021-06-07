<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the venue.
*/
class InlineQueryResultVenue extends Type{
    
    protected string $_ = 'InlineQueryResultVenue';

    /** @var string Type of the result, must be venue */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 Bytes */
    public string $id;

    /** @var float Latitude of the venue location in degrees */
    public float $latitude;

    /** @var float Longitude of the venue location in degrees */
    public float $longitude;

    /** @var string Title of the venue */
    public string $title;

    /** @var string Address of the venue */
    public string $address;

    /** @var string|null Foursquare identifier of the venue if known */
    public ?string $foursquare_id = null;

    /** @var string|null Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.) */
    public ?string $foursquare_type = null;

    /** @var string|null Google Places identifier of the venue */
    public ?string $google_place_id = null;

    /** @var string|null Google Places type of the venue. (See supported types.) */
    public ?string $google_place_type = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the venue */
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
        $this->address = $array['address'];
        $this->foursquare_id = $array['foursquare_id'] ?? null;
        $this->foursquare_type = $array['foursquare_type'] ?? null;
        $this->google_place_id = $array['google_place_id'] ?? null;
        $this->google_place_type = $array['google_place_type'] ?? null;
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        $this->input_message_content = isset($array['input_message_content']) ? new InputMessageContent($array['input_message_content'], $Bot) : null;
        $this->thumb_url = $array['thumb_url'] ?? null;
        $this->thumb_width = $array['thumb_width'] ?? null;
        $this->thumb_height = $array['thumb_height'] ?? null;
        parent::__construct($array, $Bot);
   }
    
}
