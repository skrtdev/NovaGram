# NovaGram Bot Api Methods  

## getUpdates  
Use this method to receive incoming updates using long polling (wiki).  
```php
$Bot->getUpdates($offset, $limit, $timeout, $allowed_updates);
```
Return [`Array of Update`](types/Update.md)  


## setWebhook  
Use this method to specify a url and receive incoming updates via an outgoing webhook.  
```php
$Bot->setWebhook($url, $certificate, $ip_address, $max_connections, $allowed_updates, $drop_pending_updates);
```

## deleteWebhook  
Use this method to remove webhook integration if you decide to switch back to getUpdates.  
```php
$Bot->deleteWebhook($drop_pending_updates);
```

## getWebhookInfo  
Use this method to get current webhook status.  
```php
$Bot->getWebhookInfo();
```
Return [`WebhookInfo`](types/WebhookInfo.md)  


## getMe  
A simple method for testing your bot's auth token.  
```php
$Bot->getMe();
```
Return [`User`](types/User.md)  


## logOut  
Use this method to log out from the cloud Bot API server before launching the bot locally.  
```php
$Bot->logOut();
```

## close  
Use this method to close the bot instance before moving it from one local server to another.  
```php
$Bot->close();
```

## sendMessage  
Use this method to send text messages.  
```php
$Bot->sendMessage($chat_id, $text, $parse_mode, $entities, $disable_web_page_preview, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Message::reply()`](types/Message.md#reply), [`Chat::sendMessage()`](types/Chat.md#sendmessage), [`User::sendMessage()`](types/User.md#sendmessage)  

## forwardMessage  
Use this method to forward messages of any kind.  
```php
$Bot->forwardMessage($chat_id, $from_chat_id, $disable_notification, $message_id);
```
Return [`Message`](types/Message.md)  

See also [`Message::forward()`](types/Message.md#forward), [`Chat::forwardTo()`](types/Chat.md#forwardto)  

## copyMessage  
Use this method to copy messages of any kind.  
```php
$Bot->copyMessage($chat_id, $from_chat_id, $message_id, $caption, $parse_mode, $caption_entities, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`MessageId`](types/MessageId.md)  

See also [`Message::copy()`](types/Message.md#copy), [`Chat::copyMessage()`](types/Chat.md#copymessage)  

## sendPhoto  
Use this method to send photos.  
```php
$Bot->sendPhoto($chat_id, $photo, $caption, $parse_mode, $caption_entities, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendPhoto()`](types/Chat.md#sendphoto)  

## sendAudio  
Use this method to send audio files, if you want Telegram clients to display them in the music player.  
```php
$Bot->sendAudio($chat_id, $audio, $caption, $parse_mode, $caption_entities, $duration, $performer, $title, $thumb, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  


## sendDocument  
Use this method to send general files.  
```php
$Bot->sendDocument($chat_id, $document, $thumb, $caption, $parse_mode, $caption_entities, $disable_content_type_detection, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendDocument()`](types/Chat.md#senddocument)  

## sendVideo  
Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document).  
```php
$Bot->sendVideo($chat_id, $video, $duration, $width, $height, $thumb, $caption, $parse_mode, $caption_entities, $supports_streaming, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendVideo()`](types/Chat.md#sendvideo)  

## sendAnimation  
Use this method to send animation files (GIF or H.  
```php
$Bot->sendAnimation($chat_id, $animation, $duration, $width, $height, $thumb, $caption, $parse_mode, $caption_entities, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendAnimation()`](types/Chat.md#sendanimation)  

## sendVoice  
Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.  
```php
$Bot->sendVoice($chat_id, $voice, $caption, $parse_mode, $caption_entities, $duration, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendVoice()`](types/Chat.md#sendvoice)  

## sendVideoNote  
As of v.  
```php
$Bot->sendVideoNote($chat_id, $video_note, $duration, $length, $thumb, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendVideoNote()`](types/Chat.md#sendvideonote)  

## sendMediaGroup  
Use this method to send a group of photos, videos, documents or audios as an album.  
```php
$Bot->sendMediaGroup($chat_id, $media, $disable_notification, $reply_to_message_id, $allow_sending_without_reply);
```
Return [`Array of Message`](types/Message.md)  

See also [`Chat::sendMediaGroup()`](types/Chat.md#sendmediagroup)  

## sendLocation  
Use this method to send point on the map.  
```php
$Bot->sendLocation($chat_id, $latitude, $longitude, $horizontal_accuracy, $live_period, $heading, $proximity_alert_radius, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendLocation()`](types/Chat.md#sendlocation)  

## editMessageLiveLocation  
Use this method to edit live location messages.  
```php
$Bot->editMessageLiveLocation($chat_id, $message_id, $inline_message_id, $latitude, $longitude, $horizontal_accuracy, $heading, $proximity_alert_radius, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Message::editLiveLocation()`](types/Message.md#editlivelocation), [`Chat::editMessageLiveLocation()`](types/Chat.md#editmessagelivelocation)  

## stopMessageLiveLocation  
Use this method to stop updating a live location message before live_period expires.  
```php
$Bot->stopMessageLiveLocation($chat_id, $message_id, $inline_message_id, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Message::stopLiveLocation()`](types/Message.md#stoplivelocation), [`Chat::stopMessageLiveLocation()`](types/Chat.md#stopmessagelivelocation)  

## sendVenue  
Use this method to send information about a venue.  
```php
$Bot->sendVenue($chat_id, $latitude, $longitude, $title, $address, $foursquare_id, $foursquare_type, $google_place_id, $google_place_type, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendVenue()`](types/Chat.md#sendvenue)  

## sendContact  
Use this method to send phone contacts.  
```php
$Bot->sendContact($chat_id, $phone_number, $first_name, $last_name, $vcard, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendContact()`](types/Chat.md#sendcontact)  

## sendPoll  
Use this method to send a native poll.  
```php
$Bot->sendPoll($chat_id, $question, $options, $is_anonymous, $type, $allows_multiple_answers, $correct_option_id, $explanation, $explanation_parse_mode, $explanation_entities, $open_period, $close_date, $is_closed, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendPoll()`](types/Chat.md#sendpoll)  

## sendDice  
Use this method to send an animated emoji that will display a random value.  
```php
$Bot->sendDice($chat_id, $emoji, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendDice()`](types/Chat.md#senddice)  

## sendChatAction  
Use this method when you need to tell the user that something is happening on the bot's side.  
```php
$Bot->sendChatAction($chat_id, $action);
```
See also [`Chat::sendAction()`](types/Chat.md#sendaction)  

## getUserProfilePhotos  
Use this method to get a list of profile pictures for a user.  
```php
$Bot->getUserProfilePhotos($user_id, $offset, $limit);
```
Return [`UserProfilePhotos`](types/UserProfilePhotos.md)  

See also [`User::getProfilePhotos()`](types/User.md#getprofilephotos)  

## getFile  
Use this method to get basic info about a file and prepare it for downloading.  
```php
$Bot->getFile($file_id);
```
Return [`File`](types/File.md)  

See also [`Document::get()`](types/Document.md#get)  

## banChatMember  
Use this method to ban a user in a group, a supergroup or a channel.  
```php
$Bot->banChatMember($chat_id, $user_id, $until_date, $revoke_messages);
```

## unbanChatMember  
Use this method to unban a previously banned user in a supergroup or channel.  
```php
$Bot->unbanChatMember($chat_id, $user_id, $only_if_banned);
```
See also [`Chat::unbanMember()`](types/Chat.md#unbanmember), [`User::unbanChatMember()`](types/User.md#unbanchatmember)  

## restrictChatMember  
Use this method to restrict a user in a supergroup.  
```php
$Bot->restrictChatMember($chat_id, $user_id, $permissions, $until_date);
```
See also [`Chat::restrictMember()`](types/Chat.md#restrictmember), [`User::restrictChatMember()`](types/User.md#restrictchatmember)  

## promoteChatMember  
Use this method to promote or demote a user in a supergroup or a channel.  
```php
$Bot->promoteChatMember($chat_id, $user_id, $is_anonymous, $can_manage_chat, $can_post_messages, $can_edit_messages, $can_delete_messages, $can_manage_voice_chats, $can_restrict_members, $can_promote_members, $can_change_info, $can_invite_users, $can_pin_messages);
```
See also [`Chat::promoteMember()`](types/Chat.md#promotemember), [`User::promoteChatMember()`](types/User.md#promotechatmember)  

## setChatAdministratorCustomTitle  
Use this method to set a custom title for an administrator in a supergroup promoted by the bot.  
```php
$Bot->setChatAdministratorCustomTitle($chat_id, $user_id, $custom_title);
```
See also [`Chat::setAdministratorCustomTitle()`](types/Chat.md#setadministratorcustomtitle), [`User::setChatAdministratorCustomTitle()`](types/User.md#setchatadministratorcustomtitle)  

## setChatPermissions  
Use this method to set default chat permissions for all members.  
```php
$Bot->setChatPermissions($chat_id, $permissions);
```
See also [`Chat::setPermissions()`](types/Chat.md#setpermissions)  

## exportChatInviteLink  
Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked.  
```php
$Bot->exportChatInviteLink($chat_id);
```
See also [`Chat::exportInviteLink()`](types/Chat.md#exportinvitelink)  

## createChatInviteLink  
Use this method to create an additional invite link for a chat.  
```php
$Bot->createChatInviteLink($chat_id, $expire_date, $member_limit);
```
Return [`ChatInviteLink`](types/ChatInviteLink.md)  


## editChatInviteLink  
Use this method to edit a non-primary invite link created by the bot.  
```php
$Bot->editChatInviteLink($chat_id, $invite_link, $expire_date, $member_limit);
```
Return [`ChatInviteLink`](types/ChatInviteLink.md)  


## revokeChatInviteLink  
Use this method to revoke an invite link created by the bot.  
```php
$Bot->revokeChatInviteLink($chat_id, $invite_link);
```
Return [`ChatInviteLink`](types/ChatInviteLink.md)  


## setChatPhoto  
Use this method to set a new profile photo for the chat.  
```php
$Bot->setChatPhoto($chat_id, $photo);
```
See also [`Chat::setPhoto()`](types/Chat.md#setphoto)  

## deleteChatPhoto  
Use this method to delete a chat photo.  
```php
$Bot->deleteChatPhoto($chat_id);
```
See also [`Chat::deletePhoto()`](types/Chat.md#deletephoto)  

## setChatTitle  
Use this method to change the title of a chat.  
```php
$Bot->setChatTitle($chat_id, $title);
```
See also [`Chat::setTitle()`](types/Chat.md#settitle)  

## setChatDescription  
Use this method to change the description of a group, a supergroup or a channel.  
```php
$Bot->setChatDescription($chat_id, $description);
```
See also [`Chat::setDescription()`](types/Chat.md#setdescription)  

## pinChatMessage  
Use this method to add a message to the list of pinned messages in a chat.  
```php
$Bot->pinChatMessage($chat_id, $message_id, $disable_notification);
```
See also [`Message::pin()`](types/Message.md#pin), [`Chat::pinMessage()`](types/Chat.md#pinmessage)  

## unpinChatMessage  
Use this method to remove a message from the list of pinned messages in a chat.  
```php
$Bot->unpinChatMessage($chat_id, $message_id);
```
See also [`Chat::unpinMessage()`](types/Chat.md#unpinmessage)  

## unpinAllChatMessages  
Use this method to clear the list of pinned messages in a chat.  
```php
$Bot->unpinAllChatMessages($chat_id);
```
See also [`Chat::unpinAllMessages()`](types/Chat.md#unpinallmessages)  

## leaveChat  
Use this method for your bot to leave a group, supergroup or channel.  
```php
$Bot->leaveChat($chat_id);
```
See also [`Chat::leave()`](types/Chat.md#leave)  

## getChat  
Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.  
```php
$Bot->getChat($chat_id);
```
Return [`Chat`](types/Chat.md)  

See also [`Chat::get()`](types/Chat.md#get)  

## getChatAdministrators  
Use this method to get a list of administrators in a chat.  
```php
$Bot->getChatAdministrators($chat_id);
```
Return [`Array of ChatMember`](types/ChatMember.md)  

See also [`Chat::getAdministrators()`](types/Chat.md#getadministrators)  

## getChatMemberCount  
Use this method to get the number of members in a chat.  
```php
$Bot->getChatMemberCount($chat_id);
```

## getChatMember  
Use this method to get information about a member of a chat.  
```php
$Bot->getChatMember($chat_id, $user_id);
```
Return [`ChatMember`](types/ChatMember.md)  

See also [`Chat::getMember()`](types/Chat.md#getmember), [`User::getChatMember()`](types/User.md#getchatmember)  

## setChatStickerSet  
Use this method to set a new group sticker set for a supergroup.  
```php
$Bot->setChatStickerSet($chat_id, $sticker_set_name);
```
See also [`Chat::setStickerSet()`](types/Chat.md#setstickerset)  

## deleteChatStickerSet  
Use this method to delete a group sticker set from a supergroup.  
```php
$Bot->deleteChatStickerSet($chat_id);
```
See also [`Chat::deleteStickerSet()`](types/Chat.md#deletestickerset)  

## answerCallbackQuery  
Use this method to send answers to callback queries sent from inline keyboards.  
```php
$Bot->answerCallbackQuery($callback_query_id, $text, $show_alert, $url, $cache_time);
```
See also [`CallbackQuery::answer()`](types/CallbackQuery.md#answer)  

## setMyCommands  
Use this method to change the list of the bot's commands.  
```php
$Bot->setMyCommands($commands, $scope, $language_code);
```

## deleteMyCommands  
Use this method to delete the list of the bot's commands for the given scope and user language.  
```php
$Bot->deleteMyCommands($scope, $language_code);
```

## getMyCommands  
Use this method to get the current list of the bot's commands for the given scope and user language.  
```php
$Bot->getMyCommands($scope, $language_code);
```
Return [`Array of BotCommand`](types/BotCommand.md)  


## editMessageText  
Use this method to edit text and game messages.  
```php
$Bot->editMessageText($chat_id, $message_id, $inline_message_id, $text, $parse_mode, $entities, $disable_web_page_preview, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Message::editText()`](types/Message.md#edittext), [`Chat::editMessageText()`](types/Chat.md#editmessagetext)  

## editMessageCaption  
Use this method to edit captions of messages.  
```php
$Bot->editMessageCaption($chat_id, $message_id, $inline_message_id, $caption, $parse_mode, $caption_entities, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Message::editCaption()`](types/Message.md#editcaption), [`Chat::editMessageCaption()`](types/Chat.md#editmessagecaption)  

## editMessageMedia  
Use this method to edit animation, audio, document, photo, or video messages.  
```php
$Bot->editMessageMedia($chat_id, $message_id, $inline_message_id, $media, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Message::editMedia()`](types/Message.md#editmedia), [`Chat::editMessageMedia()`](types/Chat.md#editmessagemedia)  

## editMessageReplyMarkup  
Use this method to edit only the reply markup of messages.  
```php
$Bot->editMessageReplyMarkup($chat_id, $message_id, $inline_message_id, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Message::editReplyMarkup()`](types/Message.md#editreplymarkup), [`Chat::editMessageReplyMarkup()`](types/Chat.md#editmessagereplymarkup)  

## stopPoll  
Use this method to stop a poll which was sent by the bot.  
```php
$Bot->stopPoll($chat_id, $message_id, $reply_markup);
```
Return [`Poll`](types/Poll.md)  

See also [`Message::stopPoll()`](types/Message.md#stoppoll), [`Chat::stopPoll()`](types/Chat.md#stoppoll)  

## deleteMessage  
Use this method to delete a message, including service messages, with the following limitations:- A message can only be deleted if it was sent less than 48 hours ago.  
```php
$Bot->deleteMessage($chat_id, $message_id);
```
See also [`Message::delete()`](types/Message.md#delete), [`Chat::deleteMessage()`](types/Chat.md#deletemessage)  

## sendSticker  
Use this method to send static .  
```php
$Bot->sendSticker($chat_id, $sticker, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendSticker()`](types/Chat.md#sendsticker)  

## getStickerSet  
Use this method to get a sticker set.  
```php
$Bot->getStickerSet($name);
```
Return [`StickerSet`](types/StickerSet.md)  


## uploadStickerFile  
Use this method to upload a .  
```php
$Bot->uploadStickerFile($user_id, $png_sticker);
```
Return [`File`](types/File.md)  

See also [`User::uploadStickerFile()`](types/User.md#uploadstickerfile)  

## createNewStickerSet  
Use this method to create a new sticker set owned by a user.  
```php
$Bot->createNewStickerSet($user_id, $name, $title, $png_sticker, $tgs_sticker, $emojis, $contains_masks, $mask_position);
```
See also [`User::createNewStickerSet()`](types/User.md#createnewstickerset)  

## addStickerToSet  
Use this method to add a new sticker to a set created by the bot.  
```php
$Bot->addStickerToSet($user_id, $name, $png_sticker, $tgs_sticker, $emojis, $mask_position);
```
See also [`User::addStickerToSet()`](types/User.md#addstickertoset)  

## setStickerPositionInSet  
Use this method to move a sticker in a set created by the bot to a specific position.  
```php
$Bot->setStickerPositionInSet($sticker, $position);
```

## deleteStickerFromSet  
Use this method to delete a sticker from a set created by the bot.  
```php
$Bot->deleteStickerFromSet($sticker);
```

## setStickerSetThumb  
Use this method to set the thumbnail of a sticker set.  
```php
$Bot->setStickerSetThumb($name, $user_id, $thumb);
```
See also [`User::setStickerSetThumb()`](types/User.md#setstickersetthumb)  

## answerInlineQuery  
Use this method to send answers to an inline query.  
```php
$Bot->answerInlineQuery($inline_query_id, $results, $cache_time, $is_personal, $next_offset, $switch_pm_text, $switch_pm_parameter);
```
See also [`InlineQuery::answer()`](types/InlineQuery.md#answer)  

## sendInvoice  
Use this method to send invoices.  
```php
$Bot->sendInvoice($chat_id, $title, $description, $payload, $provider_token, $currency, $prices, $max_tip_amount, $suggested_tip_amounts, $start_parameter, $provider_data, $photo_url, $photo_size, $photo_width, $photo_height, $need_name, $need_phone_number, $need_email, $need_shipping_address, $send_phone_number_to_provider, $send_email_to_provider, $is_flexible, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendInvoice()`](types/Chat.md#sendinvoice)  

## answerShippingQuery  
If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot.  
```php
$Bot->answerShippingQuery($shipping_query_id, $ok, $shipping_options, $error_message);
```

## answerPreCheckoutQuery  
Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query.  
```php
$Bot->answerPreCheckoutQuery($pre_checkout_query_id, $ok, $error_message);
```

## setPassportDataErrors  
Informs a user that some of the Telegram Passport elements they provided contains errors.  
```php
$Bot->setPassportDataErrors($user_id, $errors);
```

## sendGame  
Use this method to send a game.  
```php
$Bot->sendGame($chat_id, $game_short_name, $disable_notification, $reply_to_message_id, $allow_sending_without_reply, $reply_markup);
```
Return [`Message`](types/Message.md)  

See also [`Chat::sendGame()`](types/Chat.md#sendgame)  

## setGameScore  
Use this method to set the score of the specified user in a game.  
```php
$Bot->setGameScore($user_id, $score, $force, $disable_edit_message, $chat_id, $message_id, $inline_message_id);
```
Return [`Message`](types/Message.md)  

See also [`Message::setGameScore()`](types/Message.md#setgamescore), [`Chat::setGameScore()`](types/Chat.md#setgamescore), [`User::setGameScore()`](types/User.md#setgamescore)  

## getGameHighScores  
Use this method to get data for high score tables.  
```php
$Bot->getGameHighScores($user_id, $chat_id, $message_id, $inline_message_id);
```
Return [`Array of GameHighScore`](types/GameHighScore.md)  


