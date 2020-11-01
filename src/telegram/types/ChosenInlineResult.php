<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
*/
class ChosenInlineResult extends \Telegram\ChosenInlineResult{

    use simpleProto;

    /** @var int Yes */
    public int $chat_id;

    /** @var string Yes */
    public string $title;

    /** @var string Yes */
    public string $description;

    /** @var string Yes */
    public string $payload;

    /** @var string Yes */
    public string $provider_token;

    /** @var string Yes */
    public string $start_parameter;

    /** @var string Yes */
    public string $currency;

    /** @var stdClass Yes */
    public stdClass $prices;

    /** @var string Optional */
    public string $provider_data;

    /** @var string Optional */
    public string $photo_url;

    /** @var int Optional */
    public int $photo_size;

    /** @var int Optional */
    public int $photo_width;

    /** @var int Optional */
    public int $photo_height;

    /** @var bool Optional */
    public bool $need_name;

    /** @var bool Optional */
    public bool $need_phone_number;

    /** @var bool Optional */
    public bool $need_email;

    /** @var bool Optional */
    public bool $need_shipping_address;

    /** @var bool Optional */
    public bool $send_phone_number_to_provider;

    /** @var bool Optional */
    public bool $send_email_to_provider;

    /** @var bool Optional */
    public bool $is_flexible;

    /** @var bool Optional */
    public bool $disable_notification;

    /** @var int Optional */
    public int $reply_to_message_id;

    /** @var InlineKeyboardMarkup Optional */
    public InlineKeyboardMarkup $reply_markup;

    
}

?>
