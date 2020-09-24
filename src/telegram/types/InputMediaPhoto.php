<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a photo to be sent.
*/
class InputMediaPhoto extends \Telegram\InputMediaPhoto{

   /** @var string Type of the result, must be photo */
   public string $type;

   /** @var string File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files » */
   public string $media;

   /** @var string|null Caption of the photo to be sent, 0-1024 characters after entities parsing */
   public ?string $caption = null;

   /** @var string|null Mode for parsing entities in the photo caption. See formatting options for more details. */
   public ?string $parse_mode = null;


}

?>
