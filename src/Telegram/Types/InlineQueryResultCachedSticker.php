<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a link to a sticker stored on the Telegram servers. By default, this sticker will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the sticker.
*/
class InlineQueryResultCachedSticker extends \Telegram\InlineQueryResultCachedSticker{

    use simpleProto;

    /** @var string Type of the result, must be sticker */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid file identifier of the sticker */
    public string $sticker_file_id;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the sticker */
    public ?InputMessageContent $input_message_content = null;

    
}

?>
