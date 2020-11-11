# Game	

This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.	

## Properties	

- `$title`: _Title of the game_
- `$description`: _Description of the game_
- `$photo`: [`Array of PhotoSize`](PhotoSize.md) _Photo that will be displayed in the game message in chats._
- `$text`: _Optional. Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters._
- `$text_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc._
- `$animation`: [`Animation`](Animation.md) _Optional. Animation that will be displayed in the game message in chats. Upload via BotFather_

## Methods	
