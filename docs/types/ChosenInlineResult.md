# ChosenInlineResult	

Represents a result of an inline query that was chosen by the user and sent to their chat partner.	

## Properties	

- `$result_id`: _The unique identifier for the result that was chosen_
- `$from`: [`User`](User.md) _The user that chose the result_
- `$location`: [`Location`](Location.md) _Optional. Sender location, only for bots that require user location_
- `$inline_message_id`: _Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message._
- `$query`: _The query that was used to obtain the result_

## Methods	
