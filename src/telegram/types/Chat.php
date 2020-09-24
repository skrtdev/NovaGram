<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a chat.
*/
class Chat extends \Telegram\Chat{

   /** @var int Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. */
   public int $id;

   /** @var string Type of chat, can be either “private”, “group”, “supergroup” or “channel” */
   public string $type;

   /** @var string|null Title, for supergroups, channels and group chats */
   public ?string $title = null;

   /** @var string|null Username, for private chats, supergroups and channels if available */
   public ?string $username = null;

   /** @var string|null First name of the other party in a private chat */
   public ?string $first_name = null;

   /** @var string|null Last name of the other party in a private chat */
   public ?string $last_name = null;

   /** @var ChatPhoto|null Chat photo. Returned only in getChat. */
   public ?ChatPhoto $photo = null;

   /** @var string|null Description, for groups, supergroups and channel chats. Returned only in getChat. */
   public ?string $description = null;

   /** @var string|null Chat invite link, for groups, supergroups and channel chats. Each administrator in a chat generates their own invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat. */
   public ?string $invite_link = null;

   /** @var Message|null Pinned message, for groups, supergroups and channels. Returned only in getChat. */
   public ?Message $pinned_message = null;

   /** @var ChatPermissions|null Default chat member permissions, for groups and supergroups. Returned only in getChat. */
   public ?ChatPermissions $permissions = null;

   /** @var int|null For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user. Returned only in getChat. */
   public ?int $slow_mode_delay = null;

   /** @var string|null For supergroups, name of group sticker set. Returned only in getChat. */
   public ?string $sticker_set_name = null;

   /** @var bool|null True, if the bot can change the group sticker set. Returned only in getChat. */
   public ?bool $can_set_sticker_set = null;


}

?>
