<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a link to an article or web page.
*/
class InlineQueryResultArticle extends Type{
    
    protected string $_ = 'InlineQueryResultArticle';

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

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->input_message_content = new InputMessageContent($array['input_message_content'], $Bot);
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        $this->url = $array['url'] ?? null;
        $this->hide_url = $array['hide_url'] ?? null;
        $this->description = $array['description'] ?? null;
        $this->thumb_url = $array['thumb_url'] ?? null;
        $this->thumb_width = $array['thumb_width'] ?? null;
        $this->thumb_height = $array['thumb_height'] ?? null;
        parent::__construct($array, $Bot);
   }
    
}
