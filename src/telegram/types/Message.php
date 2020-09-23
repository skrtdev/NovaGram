<?php

namespace skrtdev\Telegram;

use \stdClass;

class Message extends \Telegram\Message{

   public int $message_id;
   public ?User $from;
   public int $date;
   public Chat $chat;
   public ?User $forward_from;
   public ?Chat $forward_from_chat;
   public ?int $forward_from_message_id;
   public ?string $forward_signature;
   public ?string $forward_sender_name;
   public ?int $forward_date;
   public ?Message $reply_to_message;
   public ?User $via_bot;
   public ?int $edit_date;
   public ?string $media_group_id;
   public ?string $author_signature;
   public ?string $text;
   public ?stdClass $entities;
   public ?Animation $animation;
   public ?Audio $audio;
   public ?Document $document;
   public ?stdClass $photo;
   public ?Sticker $sticker;
   public ?Video $video;
   public ?VideoNote $video_note;
   public ?Voice $voice;
   public ?string $caption;
   public ?stdClass $caption_entities;
   public ?Contact $contact;
   public ?Dice $dice;
   public ?Game $game;
   public ?Poll $poll;
   public ?Venue $venue;
   public ?Location $location;
   public ?stdClass $new_chat_members;
   public ?User $left_chat_member;
   public ?string $new_chat_title;
   public ?stdClass $new_chat_photo;
   public ?bool $delete_chat_photo;
   public ?bool $group_chat_created;
   public ?bool $supergroup_chat_created;
   public ?bool $channel_chat_created;
   public ?int $migrate_to_chat_id;
   public ?int $migrate_from_chat_id;
   public ?Message $pinned_message;
   public ?Invoice $invoice;
   public ?SuccessfulPayment $successful_payment;
   public ?string $connected_website;
   public ?PassportData $passport_data;
   public ?InlineKeyboardMarkup $reply_markup;

}

?>