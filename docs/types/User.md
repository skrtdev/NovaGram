# User	

This object represents a Telegram user or bot.	

## Properties	

- `$id`: _Unique identifier for this user or bot_
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

Alias of [`sendMessage`](../methods.md#sendMessage)	
_A description of the method_	

```
$user->sendMessage($text);
```
### getProfilePhotos()	

Alias of [`getUserProfilePhotos`](../methods.md#getUserProfilePhotos)	
_A description of the method_	

```
$user->getProfilePhotos($limit);
```
### kickChatMember()	

Alias of [`kickChatMember`](../methods.md#kickChatMember)	
_A description of the method_	

```
$user->kickChatMember($user_id);
```
### unbanChatMember()	

Alias of [`unbanChatMember`](../methods.md#unbanChatMember)	
_A description of the method_	

```
$user->unbanChatMember(...$args);
```
### restrictChatMember()	

Alias of [`restrictChatMember`](../methods.md#restrictChatMember)	
_A description of the method_	

```
$user->restrictChatMember($permissions);
```
### promoteChatMember()	

Alias of [`promoteChatMember`](../methods.md#promoteChatMember)	
_A description of the method_	

```
$user->promoteChatMember($can_change_info);
```
### setChatAdministratorCustomTitle()	

Alias of [`setChatAdministratorCustomTitle`](../methods.md#setChatAdministratorCustomTitle)	
_A description of the method_	

```
$user->setChatAdministratorCustomTitle($custom_title);
```
### getChatMember()	

Alias of [`getChatMember`](../methods.md#getChatMember)	
_A description of the method_	

```
$user->getChatMember($chat_id);
```
### uploadStickerFile()	

Alias of [`uploadStickerFile`](../methods.md#uploadStickerFile)	
_A description of the method_	

```
$user->uploadStickerFile($png_sticker);
```
### createNewStickerSet()	

Alias of [`createNewStickerSet`](../methods.md#createNewStickerSet)	
_A description of the method_	

```
$user->createNewStickerSet($name);
```
### addStickerToSet()	

Alias of [`addStickerToSet`](../methods.md#addStickerToSet)	
_A description of the method_	

```
$user->addStickerToSet($name);
```
### setStickerSetThumb()	

Alias of [`setStickerSetThumb`](../methods.md#setStickerSetThumb)	
_A description of the method_	

```
$user->setStickerSetThumb($thumb);
```
### setGameScore()	

Alias of [`setGameScore`](../methods.md#setGameScore)	
_A description of the method_	

```
$user->setGameScore($score);
```