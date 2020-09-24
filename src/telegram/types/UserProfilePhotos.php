<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represent a user's profile pictures.
*/
class UserProfilePhotos extends \Telegram\UserProfilePhotos{

   /** @var int Total number of profile pictures the target user has */
   public int $total_count;

   /** @var stdClass Requested profile pictures (in up to 4 sizes each) */
   public stdClass $photos;


}

?>
