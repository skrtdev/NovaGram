# InlineQuery	

This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results.	

## Properties	

- `$id`: _Unique identifier for this query_
- `$from`: [`User`](User.md) _Sender_
- `$location`: [`Location`](Location.md) _Optional. Sender location, only for bots that request user location_
- `$query`: _Text of the query (up to 256 characters)_
- `$offset`: _Offset of the results to be returned, can be controlled by the bot_

## Methods	

### answer()	

Alias of [`answerInlineQuery`](../methods.md#answerInlineQuery)	
_A description of the method_	

```
$inlinequery->answer($results);
```