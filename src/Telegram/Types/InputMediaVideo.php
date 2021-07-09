<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a video to be sent.
*/
class InputMediaVideo extends Type{
    
    /** @var string Type of the result, must be video */
    public string $type;

    /** @var string File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files » */
    public string $media;

    /** @var |null Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files » */
    public $thumb = null;

    /** @var string|null Caption of the video to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the video caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var ObjectsList|null List of special entities that appear in the caption, which can be specified instead of parse_mode */
    public ?ObjectsList $caption_entities = null;

    /** @var int|null Video width */
    public ?int $width = null;

    /** @var int|null Video height */
    public ?int $height = null;

    /** @var int|null Video duration */
    public ?int $duration = null;

    /** @var bool|null Pass True, if the uploaded video is suitable for streaming */
    public ?bool $supports_streaming = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->media = $array['media'];
        $this->thumb = $array['thumb'] ?? null;
        $this->caption = $array['caption'] ?? null;
        $this->parse_mode = $array['parse_mode'] ?? null;
        $this->caption_entities = isset($array['caption_entities']) ? new ObjectsList(iterate($array['caption_entities'], fn($item) => new MessageEntity($item, $Bot))) : null;
        $this->width = $array['width'] ?? null;
        $this->height = $array['height'] ?? null;
        $this->duration = $array['duration'] ?? null;
        $this->supports_streaming = $array['supports_streaming'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
