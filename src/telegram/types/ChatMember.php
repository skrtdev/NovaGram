<?php

namespace skrtdev\Telegram;

use \stdClass;

class ChatMember extends \Telegram\ChatMember{

   public User $user;
   public string $status;
   public ?string $custom_title;
   public ?int $until_date;
   public ?bool $can_be_edited;
   public ?bool $can_post_messages;
   public ?bool $can_edit_messages;
   public ?bool $can_delete_messages;
   public ?bool $can_restrict_members;
   public ?bool $can_promote_members;
   public ?bool $can_change_info;
   public ?bool $can_invite_users;
   public ?bool $can_pin_messages;
   public ?bool $is_member;
   public ?bool $can_send_messages;
   public ?bool $can_send_media_messages;
   public ?bool $can_send_polls;
   public ?bool $can_send_other_messages;
   public ?bool $can_add_web_page_previews;

}

?>