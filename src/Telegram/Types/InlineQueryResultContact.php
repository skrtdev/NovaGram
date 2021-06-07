<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the contact.
*/
class InlineQueryResultContact extends Type{
    
    protected string $_ = 'InlineQueryResultContact';

    /** @var string Type of the result, must be contact */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 Bytes */
    public string $id;

    /** @var string Contact's phone number */
    public string $phone_number;

    /** @var string Contact's first name */
    public string $first_name;

    /** @var string|null Contact's last name */
    public ?string $last_name = null;

    /** @var string|null Additional data about the contact in the form of a vCard, 0-2048 bytes */
    public ?string $vcard = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the contact */
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
        $this->phone_number = $array['phone_number'];
        $this->first_name = $array['first_name'];
        $this->last_name = $array['last_name'] ?? null;
        $this->vcard = $array['vcard'] ?? null;
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        $this->input_message_content = isset($array['input_message_content']) ? new InputMessageContent($array['input_message_content'], $Bot) : null;
        $this->thumb_url = $array['thumb_url'] ?? null;
        $this->thumb_width = $array['thumb_width'] ?? null;
        $this->thumb_height = $array['thumb_height'] ?? null;
        parent::__construct($array, $Bot);
   }
    
}
