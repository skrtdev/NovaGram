<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the file. Currently, only .PDF and .ZIP files can be sent using this method.
*/
class InlineQueryResultDocument extends \Telegram\InlineQueryResultDocument{

    use simpleProto;

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

    /** @var int|null Period in seconds for which the location can be updated, should be between 60 and 86400. */
    public ?int $live_period = null;

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

    
}

?>
