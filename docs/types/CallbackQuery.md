# CallbackQuery	

This object represents an incoming callback query from a callback button in an inline keyboard. If the button that originated the query was attached to a message sent by the bot, the field message will be present. If the button was attached to a message sent via the bot (in inline mode), the field inline_message_id will be present. Exactly one of the fields data or game_short_name will be present.	

## Properties	

- `$id`: _Unique identifier for this query_
- `$from`: [`User`](User.md) _Sender_
- `$message`: [`Message`](Message.md) _Optional. Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old_
- `$inline_message_id`: _Optional. Identifier of the message sent via the bot in inline mode, that originated the query._
- `$chat_instance`: _Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games._
- `$data`: _Optional. Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field._
- `$game_short_name`: _Optional. Short name of a Game to be returned, serves as the unique identifier for the game_

## Methods	

### answer()	

Alias of [`answerCallbackQuery`](../methods.md#answerCallbackQuery)	
_A description of the method_	

```
$callbackquery->answer($text);
```