# Poll	

This object contains information about a poll.	

## Properties	

- `$id`: _Unique poll identifier_
- `$question`: _Poll question, 1-255 characters_
- `$options`: [`Array of PollOption`](PollOption.md) _List of poll options_
- `$total_voter_count`: _Total number of users that voted in the poll_
- `$is_closed`: _True, if the poll is closed_
- `$is_anonymous`: _True, if the poll is anonymous_
- `$type`: _Poll type, currently can be “regular” or “quiz”_
- `$allows_multiple_answers`: _True, if the poll allows multiple answers_
- `$correct_option_id`: _Optional. 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot._
- `$explanation`: _Optional. Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters_
- `$explanation_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the explanation_
- `$open_period`: _Optional. Amount of time in seconds the poll will be active after creation_
- `$close_date`: _Optional. Point in time (Unix timestamp) when the poll will be automatically closed_

## Methods	
