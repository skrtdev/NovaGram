# Message	

This object represents a message.	

## Properties	

- `$message_id`: _Unique message identifier inside this chat_
- `$from`: [`User`](User.md) _Optional. Sender, empty for messages sent to channels_
- `$sender_chat`: [`Chat`](Chat.md) _Optional. Sender of the message, sent on behalf of a chat. The channel itself for channel messages. The supergroup itself for messages from anonymous group administrators. The linked channel for messages automatically forwarded to the discussion group_
- `$date`: _Date the message was sent in Unix time_
- `$chat`: [`Chat`](Chat.md) _Conversation the message belongs to_
- `$forward_from`: [`User`](User.md) _Optional. For forwarded messages, sender of the original message_
- `$forward_from_chat`: [`Chat`](Chat.md) _Optional. For messages forwarded from channels or from anonymous administrators, information about the original sender chat_
- `$forward_from_message_id`: _Optional. For messages forwarded from channels, identifier of the original message in the channel_
- `$forward_signature`: _Optional. For messages forwarded from channels, signature of the post author if present_
- `$forward_sender_name`: _Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages_
- `$forward_date`: _Optional. For forwarded messages, date the original message was sent in Unix time_
- `$reply_to_message`: [`Message`](Message.md) _Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply._
- `$via_bot`: [`User`](User.md) _Optional. Bot through which the message was sent_
- `$edit_date`: _Optional. Date the message was last edited in Unix time_
- `$media_group_id`: _Optional. The unique identifier of a media message group this message belongs to_
- `$author_signature`: _Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator_
- `$text`: _Optional. For text messages, the actual UTF-8 text of the message, 0-4096 characters_
- `$entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text_
- `$animation`: [`Animation`](Animation.md) _Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set_
- `$audio`: [`Audio`](Audio.md) _Optional. Message is an audio file, information about the file_
- `$document`: [`Document`](Document.md) _Optional. Message is a general file, information about the file_
- `$photo`: [`Array of PhotoSize`](PhotoSize.md) _Optional. Message is a photo, available sizes of the photo_
- `$sticker`: [`Sticker`](Sticker.md) _Optional. Message is a sticker, information about the sticker_
- `$video`: [`Video`](Video.md) _Optional. Message is a video, information about the video_
- `$video_note`: [`VideoNote`](VideoNote.md) _Optional. Message is a video note, information about the video message_
- `$voice`: [`Voice`](Voice.md) _Optional. Message is a voice message, information about the file_
- `$caption`: _Optional. Caption for the animation, audio, document, photo, video or voice, 0-1024 characters_
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption_
- `$contact`: [`Contact`](Contact.md) _Optional. Message is a shared contact, information about the contact_
- `$dice`: [`Dice`](Dice.md) _Optional. Message is a dice with random value from 1 to 6_
- `$game`: [`Game`](Game.md) _Optional. Message is a game, information about the game. More about games »_
- `$poll`: [`Poll`](Poll.md) _Optional. Message is a native poll, information about the poll_
- `$venue`: [`Venue`](Venue.md) _Optional. Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set_
- `$location`: [`Location`](Location.md) _Optional. Message is a shared location, information about the location_
- `$new_chat_members`: [`Array of User`](User.md) _Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)_
- `$left_chat_member`: [`User`](User.md) _Optional. A member was removed from the group, information about them (this member may be the bot itself)_
- `$new_chat_title`: _Optional. A chat title was changed to this value_
- `$new_chat_photo`: [`Array of PhotoSize`](PhotoSize.md) _Optional. A chat photo was change to this value_
- `$delete_chat_photo`: [`True`](True.md) _Optional. Service message: the chat photo was deleted_
- `$group_chat_created`: [`True`](True.md) _Optional. Service message: the group has been created_
- `$supergroup_chat_created`: [`True`](True.md) _Optional. Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup._
- `$channel_chat_created`: [`True`](True.md) _Optional. Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel._
- `$migrate_to_chat_id`: _Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier._
- `$migrate_from_chat_id`: _Optional. The supergroup has been migrated from a group with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier._
- `$pinned_message`: [`Message`](Message.md) _Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply._
- `$invoice`: [`Invoice`](Invoice.md) _Optional. Message is an invoice for a payment, information about the invoice. More about payments »_
- `$successful_payment`: [`SuccessfulPayment`](SuccessfulPayment.md) _Optional. Message is a service message about a successful payment, information about the payment. More about payments »_
- `$connected_website`: _Optional. The domain name of the website on which the user has logged in. More about Telegram Login »_
- `$passport_data`: [`PassportData`](PassportData.md) _Optional. Telegram Passport data_
- `$proximity_alert_triggered`: [`ProximityAlertTriggered`](ProximityAlertTriggered.md) _Optional. Service message. A user in the chat triggered another user's proximity alert while sharing Live Location._
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons._

## Methods	

### forward()	

Alias of [`forwardMessage`](../methods.md#forwardMessage)	
_A description of the method_	

```
$message->forward($chat_id);
```
### reply()	

Alias of [`sendMessage`](../methods.md#sendMessage)	
_A description of the method_	

```
$message->reply($text);
```
### delete()	

Alias of [`deleteMessage`](../methods.md#deleteMessage)	
_A description of the method_	

```
$message->delete(...$args);
```
### editText()	

Alias of [`editMessageText`](../methods.md#editMessageText)	
_A description of the method_	

```
$message->editText($text);
```
### editLiveLocation()	

Alias of [`editMessageLiveLocation`](../methods.md#editMessageLiveLocation)	
_A description of the method_	

```
$message->editLiveLocation(...$args);
```
### stopLiveLocation()	

Alias of [`stopMessageLiveLocation`](../methods.md#stopMessageLiveLocation)	
_A description of the method_	

```
$message->stopLiveLocation($reply_markup);
```
### pin()	

Alias of [`pinChatMessage`](../methods.md#pinChatMessage)	
_A description of the method_	

```
$message->pin($disable_notification);
```
### editCaption()	

Alias of [`editMessageCaption`](../methods.md#editMessageCaption)	
_A description of the method_	

```
$message->editCaption($caption);
```
### editMedia()	

Alias of [`editMessageMedia`](../methods.md#editMessageMedia)	
_A description of the method_	

```
$message->editMedia($media);
```
### editReplyMarkup()	

Alias of [`editMessageReplyMarkup`](../methods.md#editMessageReplyMarkup)	
_A description of the method_	

```
$message->editReplyMarkup($reply_markup);
```
### stopPoll()	

Alias of [`stopPoll`](../methods.md#stopPoll)	
_A description of the method_	

```
$message->stopPoll($reply_markup);
```
### setGameScore()	

Alias of [`setGameScore`](../methods.md#setGameScore)	
_A description of the method_	

```
$message->setGameScore($inline_message_id);
```
### copy()	

Alias of [`copyMessage`](../methods.md#copyMessage)	
_A description of the method_	

```
$message->copy($chat_id);
```