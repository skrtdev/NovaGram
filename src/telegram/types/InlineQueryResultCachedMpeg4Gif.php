<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound) stored on the Telegram servers. By default, this animated MPEG-4 file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
*/
class InlineQueryResultCachedMpeg4Gif extends \Telegram\InlineQueryResultCachedMpeg4Gif{

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
