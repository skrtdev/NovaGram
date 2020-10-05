<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
*/
class Document extends \Telegram\Document{

    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var PhotoSize|null Document thumbnail as defined by sender */
    public ?PhotoSize $thumb = null;

    /** @var string|null Original filename as defined by sender */
    public ?string $file_name = null;

    /** @var string|null MIME type of the file as defined by sender */
    public ?string $mime_type = null;

    /** @var int|null File size */
    public ?int $file_size = null;

    public function getFile(bool $payload = false){
        $params = [];
        $params['file_id'] = $this->presetToValue('file_id');
        return $this->Bot->APICall("getFile", $params, $payload);
    }

    public function deleteMessage($file_unique_id = null, $args = null, bool $payload = false){
        if(is_array($file_unique_id)){
            $payload = $args ?? false; // 2nd param
            $params = $file_unique_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['file_unique_id' => $file_unique_id] + ($args ?? []);
        }
        $params['file_id'] = $this->presetToValue('file_id');
        return $this->Bot->APICall("deleteMessage", $params, $payload);
    }
}

?>
