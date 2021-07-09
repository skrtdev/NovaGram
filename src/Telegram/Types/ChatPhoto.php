<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a chat photo.
*/
class ChatPhoto extends Type{
    
    /** @var string File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed. */
    public string $small_file_id;

    /** @var string Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $small_file_unique_id;

    /** @var string File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed. */
    public string $big_file_id;

    /** @var string Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $big_file_unique_id;

    public function __construct(array $array, Bot $Bot = null){
        $this->small_file_id = $array['small_file_id'];
        $this->small_file_unique_id = $array['small_file_unique_id'];
        $this->big_file_id = $array['big_file_id'];
        $this->big_file_unique_id = $array['big_file_unique_id'];
        parent::__construct($array, $Bot);
    }
    
    
}
