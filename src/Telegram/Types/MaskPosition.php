<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object describes the position on faces where a mask should be placed by default.
*/
class MaskPosition extends \Telegram\MaskPosition{

    use simpleProto;

    /** @var int|string Yes */
    public $chat_id;

    /** @var InputFile|string Yes */
    public $sticker;

    /** @var bool Optional */
    public bool $disable_notification;

    /** @var int Optional */
    public int $reply_to_message_id;

    /** @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply Optional */
    public $reply_markup;

    
}

?>
