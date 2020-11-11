# MessageEntity	

This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.	

## Properties	

- `$type`: _Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames)_
- `$offset`: _Offset in UTF-16 code units to the start of the entity_
- `$length`: _Length of the entity in UTF-16 code units_
- `$url`: _Optional. For “text_link” only, url that will be opened after user taps on the text_
- `$user`: [`User`](User.md) _Optional. For “text_mention” only, the mentioned user_
- `$language`: _Optional. For “pre” only, the programming language of the entity text_

## Methods	
