# Chat	

This object represents a chat.	

## Properties	

- `$id`: _Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier._
- `$type`: _Type of chat, can be either “private”, “group”, “supergroup” or “channel”_
- `$title`: _Optional. Title, for supergroups, channels and group chats_
- `$username`: _Optional. Username, for private chats, supergroups and channels if available_
- `$first_name`: _Optional. First name of the other party in a private chat_
- `$last_name`: _Optional. Last name of the other party in a private chat_
- `$photo`: [`ChatPhoto`](ChatPhoto.md) _Optional. Chat photo. Returned only in getChat._
- `$bio`: _Optional. Bio of the other party in a private chat. Returned only in getChat._
- `$description`: _Optional. Description, for groups, supergroups and channel chats. Returned only in getChat._
- `$invite_link`: _Optional. Chat invite link, for groups, supergroups and channel chats. Each administrator in a chat generates their own invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat._
- `$pinned_message`: [`Message`](Message.md) _Optional. The most recent pinned message (by sending date). Returned only in getChat._
- `$permissions`: [`ChatPermissions`](ChatPermissions.md) _Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat._
- `$slow_mode_delay`: _Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user. Returned only in getChat._
- `$sticker_set_name`: _Optional. For supergroups, name of group sticker set. Returned only in getChat._
- `$can_set_sticker_set`: _Optional. True, if the bot can change the group sticker set. Returned only in getChat._
- `$linked_chat_id`: _Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat._
- `$location`: [`ChatLocation`](ChatLocation.md) _Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat._

## Methods	

### sendMessage()	

Alias of [`sendMessage`](../methods.md#sendMessage)	
_A description of the method_	

```
$chat->sendMessage($text);
```
### forwardTo()	

Alias of [`forwardMessage`](../methods.md#forwardMessage)	
_A description of the method_	

```
$chat->forwardTo(...$args);
```
### deleteMessage()	

Alias of [`deleteMessage`](../methods.md#deleteMessage)	
_A description of the method_	

```
$chat->deleteMessage($message_id);
```
### sendAction()	

Alias of [`sendChatAction`](../methods.md#sendChatAction)	
_A description of the method_	

```
$chat->sendAction($action);
```
### sendPhoto()	

Alias of [`sendPhoto`](../methods.md#sendPhoto)	
_A description of the method_	

```
$chat->sendPhoto($photo);
```
### sendDocument()	

Alias of [`sendDocument`](../methods.md#sendDocument)	
_A description of the method_	

```
$chat->sendDocument($document);
```
### sendVideo()	

Alias of [`sendVideo`](../methods.md#sendVideo)	
_A description of the method_	

```
$chat->sendVideo($video);
```
### sendAnimation()	

Alias of [`sendAnimation`](../methods.md#sendAnimation)	
_A description of the method_	

```
$chat->sendAnimation($animation);
```
### sendVoice()	

Alias of [`sendVoice`](../methods.md#sendVoice)	
_A description of the method_	

```
$chat->sendVoice($voice);
```
### sendVideoNote()	

Alias of [`sendVideoNote`](../methods.md#sendVideoNote)	
_A description of the method_	

```
$chat->sendVideoNote($video_note);
```
### sendMediaGroup()	

Alias of [`sendMediaGroup`](../methods.md#sendMediaGroup)	
_A description of the method_	

```
$chat->sendMediaGroup($media);
```
### sendLocation()	

Alias of [`sendLocation`](../methods.md#sendLocation)	
_A description of the method_	

```
$chat->sendLocation($latitude);
```
### editMessageLiveLocation()	

Alias of [`editMessageLiveLocation`](../methods.md#editMessageLiveLocation)	
_A description of the method_	

```
$chat->editMessageLiveLocation($message_id);
```
### stopMessageLiveLocation()	

Alias of [`stopMessageLiveLocation`](../methods.md#stopMessageLiveLocation)	
_A description of the method_	

```
$chat->stopMessageLiveLocation($message_id);
```
### sendVenue()	

Alias of [`sendVenue`](../methods.md#sendVenue)	
_A description of the method_	

```
$chat->sendVenue($latitude);
```
### sendContact()	

Alias of [`sendContact`](../methods.md#sendContact)	
_A description of the method_	

```
$chat->sendContact($phone_number);
```
### sendPoll()	

Alias of [`sendPoll`](../methods.md#sendPoll)	
_A description of the method_	

```
$chat->sendPoll($question);
```
### sendDice()	

Alias of [`sendDice`](../methods.md#sendDice)	
_A description of the method_	

```
$chat->sendDice($emoji);
```
### kickMember()	

Alias of [`kickChatMember`](../methods.md#kickChatMember)	
_A description of the method_	

```
$chat->kickMember($user_id);
```
### unbanMember()	

Alias of [`unbanChatMember`](../methods.md#unbanChatMember)	
_A description of the method_	

```
$chat->unbanMember($user_id);
```
### restrictMember()	

Alias of [`restrictChatMember`](../methods.md#restrictChatMember)	
_A description of the method_	

```
$chat->restrictMember($user_id);
```
### promoteMember()	

Alias of [`promoteChatMember`](../methods.md#promoteChatMember)	
_A description of the method_	

```
$chat->promoteMember($user_id);
```
### setAdministratorCustomTitle()	

Alias of [`setChatAdministratorCustomTitle`](../methods.md#setChatAdministratorCustomTitle)	
_A description of the method_	

```
$chat->setAdministratorCustomTitle($user_id);
```
### setPermissions()	

Alias of [`setChatPermissions`](../methods.md#setChatPermissions)	
_A description of the method_	

```
$chat->setPermissions($permissions);
```
### exportInviteLink()	

Alias of [`exportChatInviteLink`](../methods.md#exportChatInviteLink)	
_A description of the method_	

```
$chat->exportInviteLink(...$args);
```
### setPhoto()	

Alias of [`setChatPhoto`](../methods.md#setChatPhoto)	
_A description of the method_	

```
$chat->setPhoto($photo);
```
### deletePhoto()	

Alias of [`deleteChatPhoto`](../methods.md#deleteChatPhoto)	
_A description of the method_	

```
$chat->deletePhoto(...$args);
```
### setTitle()	

Alias of [`setChatTitle`](../methods.md#setChatTitle)	
_A description of the method_	

```
$chat->setTitle($title);
```
### setDescription()	

Alias of [`setChatDescription`](../methods.md#setChatDescription)	
_A description of the method_	

```
$chat->setDescription($description);
```
### pinMessage()	

Alias of [`pinChatMessage`](../methods.md#pinChatMessage)	
_A description of the method_	

```
$chat->pinMessage($message_id);
```
### unpinMessage()	

Alias of [`unpinChatMessage`](../methods.md#unpinChatMessage)	
_A description of the method_	

```
$chat->unpinMessage(...$args);
```
### leave()	

Alias of [`leaveChat`](../methods.md#leaveChat)	
_A description of the method_	

```
$chat->leave(...$args);
```
### get()	

Alias of [`getChat`](../methods.md#getChat)	
_A description of the method_	

```
$chat->get(...$args);
```
### getAdministrators()	

Alias of [`getChatAdministrators`](../methods.md#getChatAdministrators)	
_A description of the method_	

```
$chat->getAdministrators(...$args);
```
### getMembersCount()	

Alias of [`getChatMembersCount`](../methods.md#getChatMembersCount)	
_A description of the method_	

```
$chat->getMembersCount(...$args);
```
### getMember()	

Alias of [`getChatMember`](../methods.md#getChatMember)	
_A description of the method_	

```
$chat->getMember($user_id);
```
### setStickerSet()	

Alias of [`setChatStickerSet`](../methods.md#setChatStickerSet)	
_A description of the method_	

```
$chat->setStickerSet($sticker_set_name);
```
### deleteStickerSet()	

Alias of [`deleteChatStickerSet`](../methods.md#deleteChatStickerSet)	
_A description of the method_	

```
$chat->deleteStickerSet(...$args);
```
### editMessageText()	

Alias of [`editMessageText`](../methods.md#editMessageText)	
_A description of the method_	

```
$chat->editMessageText($message_id);
```
### editMessageCaption()	

Alias of [`editMessageCaption`](../methods.md#editMessageCaption)	
_A description of the method_	

```
$chat->editMessageCaption($message_id);
```
### editMessageMedia()	

Alias of [`editMessageMedia`](../methods.md#editMessageMedia)	
_A description of the method_	

```
$chat->editMessageMedia($message_id);
```
### editMessageReplyMarkup()	

Alias of [`editMessageReplyMarkup`](../methods.md#editMessageReplyMarkup)	
_A description of the method_	

```
$chat->editMessageReplyMarkup($message_id);
```
### stopPoll()	

Alias of [`stopPoll`](../methods.md#stopPoll)	
_A description of the method_	

```
$chat->stopPoll($message_id);
```
### sendSticker()	

Alias of [`sendSticker`](../methods.md#sendSticker)	
_A description of the method_	

```
$chat->sendSticker($sticker);
```
### sendInvoice()	

Alias of [`sendInvoice`](../methods.md#sendInvoice)	
_A description of the method_	

```
$chat->sendInvoice($title);
```
### sendGame()	

Alias of [`sendGame`](../methods.md#sendGame)	
_A description of the method_	

```
$chat->sendGame($game_short_name);
```
### setGameScore()	

Alias of [`setGameScore`](../methods.md#setGameScore)	
_A description of the method_	

```
$chat->setGameScore($message_id);
```
### copyMessage()	

Alias of [`copyMessage`](../methods.md#copyMessage)	
_A description of the method_	

```
$chat->copyMessage($message_id);
```
### unpinAllMessages()	

Alias of [`unpinAllChatMessages`](../methods.md#unpinAllChatMessages)	
_A description of the method_	

```
$chat->unpinAllMessages(...$args);
```