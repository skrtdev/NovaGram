<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represent a user's profile pictures.
*/
class UserProfilePhotos extends Type{
    
    /** @var int Total number of profile pictures the target user has */
    public int $total_count;

    /** @var ObjectsList Requested profile pictures (in up to 4 sizes each) */
    public ObjectsList $photos;

    public function __construct(array $array, Bot $Bot = null){
        $this->total_count = $array['total_count'];
        $this->photos = new ObjectsList(iterate($array['photos'], fn($item) => new ObjectsList(iterate($item, fn($item) => new PhotoSize($item, $Bot)))));
        parent::__construct($array, $Bot);
    }
    
    
}
