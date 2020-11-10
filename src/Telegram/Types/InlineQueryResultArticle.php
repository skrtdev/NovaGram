<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a link to an article or web page.
*/
class InlineQueryResultArticle extends \Telegram\InlineQueryResultArticle{

    use simpleProto;

    /** @var string Type of the result, must be article */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 Bytes */
    public string $id;

    /** @var string Title of the result */
    public string $title;

    /** @var InputMessageContent Content of the message to be sent */
    public InputMessageContent $input_message_content;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var string|null URL of the result */
    public ?string $url = null;

    /** @var bool|null Pass True, if you don't want the URL to be shown in the message */
    public ?bool $hide_url = null;

    /** @var string|null Short description of the result */
    public ?string $description = null;

    /** @var string|null Url of the thumbnail for the result */
    public ?string $thumb_url = null;

    /** @var int|null Thumbnail width */
    public ?int $thumb_width = null;

    /** @var int|null Thumbnail height */
    public ?int $thumb_height = null;

    
}

?>
