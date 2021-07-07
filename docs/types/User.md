# User	

This object represents a Telegram user or bot.	

## Properties	

- `$id`: _Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier._
- `$is_bot`: _True, if this user is a bot_
- `$first_name`: _User's or bot's first name_
- `$last_name`: _Optional. User's or bot's last name_
- `$username`: _Optional. User's or bot's username_
- `$language_code`: _Optional. IETF language tag of the user's language_
- `$can_join_groups`: _Optional. True, if the bot can be invited to groups. Returned only in getMe._
- `$can_read_all_group_messages`: _Optional. True, if privacy mode is disabled for the bot. Returned only in getMe._
- `$supports_inline_queries`: _Optional. True, if the bot supports inline queries. Returned only in getMe._

## Methods  

### sendMessage()	

Alias of [`sendMessage`](../methods.md#sendmessage)	
```php
$user->sendMessage($text);
```
### getProfilePhotos()	

Alias of [`getUserProfilePhotos`](../methods.md#getuserprofilephotos)	
```php
$user->getProfilePhotos($limit);
```
### kickChatMember()	

Alias of [`kickChatMember`](../methods.md#kickchatmember)	
```php
$user->kickChatMember($user_id);
```
### unbanChatMember()	

Alias of [`unbanChatMember`](../methods.md#unbanchatmember)	
```php
$user->unbanChatMember(...$args);
```
### restrictChatMember()	

Alias of [`restrictChatMember`](../methods.md#restrictchatmember)	
```php
$user->restrictChatMember($permissions);
```
### promoteChatMember()	

Alias of [`promoteChatMember`](../methods.md#promotechatmember)	
```php
$user->promoteChatMember($can_change_info);
```
### setChatAdministratorCustomTitle()	

Alias of [`setChatAdministratorCustomTitle`](../methods.md#setchatadministratorcustomtitle)	
```php
$user->setChatAdministratorCustomTitle($custom_title);
```
### getChatMember()	

Alias of [`getChatMember`](../methods.md#getchatmember)	
```php
$user->getChatMember($chat_id);
```
### uploadStickerFile()	

Alias of [`uploadStickerFile`](../methods.md#uploadstickerfile)	
```php
$user->uploadStickerFile($png_sticker);
```
### createNewStickerSet()	

Alias of [`createNewStickerSet`](../methods.md#createnewstickerset)	
```php
$user->createNewStickerSet($name);
```
### addStickerToSet()	

Alias of [`addStickerToSet`](../methods.md#addstickertoset)	
```php
$user->addStickerToSet($name);
```
### setStickerSetThumb()	

Alias of [`setStickerSetThumb`](../methods.md#setstickersetthumb)	
```php
$user->setStickerSetThumb($thumb);
```
### setGameScore()	

Alias of [`setGameScore`](../methods.md#setgamescore)	
```php
$user->setGameScore($score);
```