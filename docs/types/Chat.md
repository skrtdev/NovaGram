# Chat	

This object represents a chat.	

## Properties	

- `$id`: _Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier._
- `$type`: _Type of chat, can be either “private”, “group”, “supergroup” or “channel”_
- `$title`: _Optional. Title, for supergroups, channels and group chats_
- `$username`: _Optional. Username, for private chats, supergroups and channels if available_
- `$first_name`: _Optional. First name of the other party in a private chat_
- `$last_name`: _Optional. Last name of the other party in a private chat_
- `$photo`: [`ChatPhoto`](ChatPhoto.md) _Optional. Chat photo. Returned only in getChat._
- `$bio`: _Optional. Bio of the other party in a private chat. Returned only in getChat._
- `$description`: _Optional. Description, for groups, supergroups and channel chats. Returned only in getChat._
- `$invite_link`: _Optional. Primary invite link, for groups, supergroups and channel chats. Returned only in getChat._
- `$pinned_message`: [`Message`](Message.md) _Optional. The most recent pinned message (by sending date). Returned only in getChat._
- `$permissions`: [`ChatPermissions`](ChatPermissions.md) _Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat._
- `$slow_mode_delay`: _Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user. Returned only in getChat._
- `$message_auto_delete_time`: _Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat._
- `$sticker_set_name`: _Optional. For supergroups, name of group sticker set. Returned only in getChat._
- `$can_set_sticker_set`: _Optional. True, if the bot can change the group sticker set. Returned only in getChat._
- `$linked_chat_id`: _Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat._
- `$location`: [`ChatLocation`](ChatLocation.md) _Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat._

## Methods  

### sendMessage()	

Alias of [`sendMessage`](../methods.md#sendmessage)	
```php
$chat->sendMessage($text);
```
### forwardTo()	

Alias of [`forwardMessage`](../methods.md#forwardmessage)	
```php
$chat->forwardTo(...$args);
```
### deleteMessage()	

Alias of [`deleteMessage`](../methods.md#deletemessage)	
```php
$chat->deleteMessage($message_id);
```
### sendAction()	

Alias of [`sendChatAction`](../methods.md#sendchataction)	
```php
$chat->sendAction($action);
```
### sendPhoto()	

Alias of [`sendPhoto`](../methods.md#sendphoto)	
```php
$chat->sendPhoto($photo);
```
### sendDocument()	

Alias of [`sendDocument`](../methods.md#senddocument)	
```php
$chat->sendDocument($document);
```
### sendVideo()	

Alias of [`sendVideo`](../methods.md#sendvideo)	
```php
$chat->sendVideo($video);
```
### sendAnimation()	

Alias of [`sendAnimation`](../methods.md#sendanimation)	
```php
$chat->sendAnimation($animation);
```
### sendVoice()	

Alias of [`sendVoice`](../methods.md#sendvoice)	
```php
$chat->sendVoice($voice);
```
### sendVideoNote()	

Alias of [`sendVideoNote`](../methods.md#sendvideonote)	
```php
$chat->sendVideoNote($video_note);
```
### sendMediaGroup()	

Alias of [`sendMediaGroup`](../methods.md#sendmediagroup)	
```php
$chat->sendMediaGroup($media);
```
### sendLocation()	

Alias of [`sendLocation`](../methods.md#sendlocation)	
```php
$chat->sendLocation($latitude);
```
### editMessageLiveLocation()	

Alias of [`editMessageLiveLocation`](../methods.md#editmessagelivelocation)	
```php
$chat->editMessageLiveLocation($message_id);
```
### stopMessageLiveLocation()	

Alias of [`stopMessageLiveLocation`](../methods.md#stopmessagelivelocation)	
```php
$chat->stopMessageLiveLocation($message_id);
```
### sendVenue()	

Alias of [`sendVenue`](../methods.md#sendvenue)	
```php
$chat->sendVenue($latitude);
```
### sendContact()	

Alias of [`sendContact`](../methods.md#sendcontact)	
```php
$chat->sendContact($phone_number);
```
### sendPoll()	

Alias of [`sendPoll`](../methods.md#sendpoll)	
```php
$chat->sendPoll($question);
```
### sendDice()	

Alias of [`sendDice`](../methods.md#senddice)	
```php
$chat->sendDice($emoji);
```
### kickMember()	

Alias of [`kickChatMember`](../methods.md#kickchatmember)	
```php
$chat->kickMember($user_id);
```
### unbanMember()	

Alias of [`unbanChatMember`](../methods.md#unbanchatmember)	
```php
$chat->unbanMember($user_id);
```
### restrictMember()	

Alias of [`restrictChatMember`](../methods.md#restrictchatmember)	
```php
$chat->restrictMember($user_id);
```
### promoteMember()	

Alias of [`promoteChatMember`](../methods.md#promotechatmember)	
```php
$chat->promoteMember($user_id);
```
### setAdministratorCustomTitle()	

Alias of [`setChatAdministratorCustomTitle`](../methods.md#setchatadministratorcustomtitle)	
```php
$chat->setAdministratorCustomTitle($user_id);
```
### setPermissions()	

Alias of [`setChatPermissions`](../methods.md#setchatpermissions)	
```php
$chat->setPermissions($permissions);
```
### exportInviteLink()	

Alias of [`exportChatInviteLink`](../methods.md#exportchatinvitelink)	
```php
$chat->exportInviteLink(...$args);
```
### setPhoto()	

Alias of [`setChatPhoto`](../methods.md#setchatphoto)	
```php
$chat->setPhoto($photo);
```
### deletePhoto()	

Alias of [`deleteChatPhoto`](../methods.md#deletechatphoto)	
```php
$chat->deletePhoto(...$args);
```
### setTitle()	

Alias of [`setChatTitle`](../methods.md#setchattitle)	
```php
$chat->setTitle($title);
```
### setDescription()	

Alias of [`setChatDescription`](../methods.md#setchatdescription)	
```php
$chat->setDescription($description);
```
### pinMessage()	

Alias of [`pinChatMessage`](../methods.md#pinchatmessage)	
```php
$chat->pinMessage($message_id);
```
### unpinMessage()	

Alias of [`unpinChatMessage`](../methods.md#unpinchatmessage)	
```php
$chat->unpinMessage(...$args);
```
### leave()	

Alias of [`leaveChat`](../methods.md#leavechat)	
```php
$chat->leave(...$args);
```
### get()	

Alias of [`getChat`](../methods.md#getchat)	
```php
$chat->get(...$args);
```
### getAdministrators()	

Alias of [`getChatAdministrators`](../methods.md#getchatadministrators)	
```php
$chat->getAdministrators(...$args);
```
### getMembersCount()	

Alias of [`getChatMembersCount`](../methods.md#getchatmemberscount)	
```php
$chat->getMembersCount(...$args);
```
### getMember()	

Alias of [`getChatMember`](../methods.md#getchatmember)	
```php
$chat->getMember($user_id);
```
### setStickerSet()	

Alias of [`setChatStickerSet`](../methods.md#setchatstickerset)	
```php
$chat->setStickerSet($sticker_set_name);
```
### deleteStickerSet()	

Alias of [`deleteChatStickerSet`](../methods.md#deletechatstickerset)	
```php
$chat->deleteStickerSet(...$args);
```
### editMessageText()	

Alias of [`editMessageText`](../methods.md#editmessagetext)	
```php
$chat->editMessageText($message_id);
```
### editMessageCaption()	

Alias of [`editMessageCaption`](../methods.md#editmessagecaption)	
```php
$chat->editMessageCaption($message_id);
```
### editMessageMedia()	

Alias of [`editMessageMedia`](../methods.md#editmessagemedia)	
```php
$chat->editMessageMedia($message_id);
```
### editMessageReplyMarkup()	

Alias of [`editMessageReplyMarkup`](../methods.md#editmessagereplymarkup)	
```php
$chat->editMessageReplyMarkup($message_id);
```
### stopPoll()	

Alias of [`stopPoll`](../methods.md#stoppoll)	
```php
$chat->stopPoll($message_id);
```
### sendSticker()	

Alias of [`sendSticker`](../methods.md#sendsticker)	
```php
$chat->sendSticker($sticker);
```
### sendInvoice()	

Alias of [`sendInvoice`](../methods.md#sendinvoice)	
```php
$chat->sendInvoice($title);
```
### sendGame()	

Alias of [`sendGame`](../methods.md#sendgame)	
```php
$chat->sendGame($game_short_name);
```
### setGameScore()	

Alias of [`setGameScore`](../methods.md#setgamescore)	
```php
$chat->setGameScore($message_id);
```
### copyMessage()	

Alias of [`copyMessage`](../methods.md#copymessage)	
```php
$chat->copyMessage($message_id);
```
### unpinAllMessages()	

Alias of [`unpinAllChatMessages`](../methods.md#unpinallchatmessages)	
```php
$chat->unpinAllMessages(...$args);
```