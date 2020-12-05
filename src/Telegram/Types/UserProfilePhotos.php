<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represent a user's profile pictures.
*/
class UserProfilePhotos extends \Telegram\UserProfilePhotos{

    use simpleProto;

    /** @var int Total number of profile pictures the target user has */
    public int $total_count;

    /** @var ObjectsList Requested profile pictures (in up to 4 sizes each) */
    public ObjectsList $photos;

    
}

?>
