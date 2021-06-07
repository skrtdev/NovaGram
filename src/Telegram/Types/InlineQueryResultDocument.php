<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the file. Currently, only .PDF and .ZIP files can be sent using this method.
*/
class InlineQueryResultDocument extends Type{
    
    protected string $_ = 'InlineQueryResultDocument';

    /** @var string Type of the result, must be document */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string Title for the result */
    public string $title;

    /** @var string|null Caption of the document to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the document caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var ObjectsList|null List of special entities that appear in the caption, which can be specified instead of parse_mode */
    public ?ObjectsList $caption_entities = null;

    /** @var string A valid URL for the file */
    public string $document_url;

    /** @var string Mime type of the content of the file, either “application/pdf” or “application/zip” */
    public string $mime_type;

    /** @var string|null Short description of the result */
    public ?string $description = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the file */
    public ?InputMessageContent $input_message_content = null;

    /** @var string|null URL of the thumbnail (jpeg only) for the file */
    public ?string $thumb_url = null;

    /** @var int|null Thumbnail width */
    public ?int $thumb_width = null;

    /** @var int|null Thumbnail height */
    public ?int $thumb_height = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->caption = $array['caption'] ?? null;
        $this->parse_mode = $array['parse_mode'] ?? null;
        $this->caption_entities = isset($array['caption_entities']) ? new ObjectsList(iterate($array['caption_entities'], fn($item) => new MessageEntity($item, $Bot))) : null;
        $this->document_url = $array['document_url'];
        $this->mime_type = $array['mime_type'];
        $this->description = $array['description'] ?? null;
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        $this->input_message_content = isset($array['input_message_content']) ? new InputMessageContent($array['input_message_content'], $Bot) : null;
        $this->thumb_url = $array['thumb_url'] ?? null;
        $this->thumb_width = $array['thumb_width'] ?? null;
        $this->thumb_height = $array['thumb_height'] ?? null;
        parent::__construct($array, $Bot);
   }
    
}
