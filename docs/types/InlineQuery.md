# InlineQuery	

This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results.	

## Properties	

- `$id`: _Unique identifier for this query_
- `$from`: [`User`](User.md) _Sender_
- `$query`: _Text of the query (up to 256 characters)_
- `$offset`: _Offset of the results to be returned, can be controlled by the bot_
- `$chat_type`: _Optional. Type of the chat, from which the inline query was sent. Can be either “sender” for a private chat with the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for requests sent from official clients and most third-party clients, unless the request was sent from a secret chat_
- `$location`: [`Location`](Location.md) _Optional. Sender location, only for bots that request user location_

## Methods  

### answer()	

Alias of [`answerInlineQuery`](../methods.md#answerinlinequery)	
```php
$inlinequery->answer($results);
```