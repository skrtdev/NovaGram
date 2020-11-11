# PollAnswer	

This object represents an answer of a user in a non-anonymous poll.	

## Properties	

- `$poll_id`: _Unique poll identifier_
- `$user`: [`User`](User.md) _The user, who changed the answer to the poll_
- `$option_ids`: _0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote._

## Methods	
