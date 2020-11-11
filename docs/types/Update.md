# Update	

This object represents an incoming update.At most one of the optional parameters can be present in any given update.	

## Properties	

- `$update_id`: _The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you're using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially._
- `$message`: [`Message`](Message.md) _Optional. New incoming message of any kind — text, photo, sticker, etc._
- `$edited_message`: [`Message`](Message.md) _Optional. New version of a message that is known to the bot and was edited_
- `$channel_post`: [`Message`](Message.md) _Optional. New incoming channel post of any kind — text, photo, sticker, etc._
- `$edited_channel_post`: [`Message`](Message.md) _Optional. New version of a channel post that is known to the bot and was edited_
- `$inline_query`: [`InlineQuery`](InlineQuery.md) _Optional. New incoming inline query_
- `$chosen_inline_result`: [`ChosenInlineResult`](ChosenInlineResult.md) _Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot._
- `$callback_query`: [`CallbackQuery`](CallbackQuery.md) _Optional. New incoming callback query_
- `$shipping_query`: [`ShippingQuery`](ShippingQuery.md) _Optional. New incoming shipping query. Only for invoices with flexible price_
- `$pre_checkout_query`: [`PreCheckoutQuery`](PreCheckoutQuery.md) _Optional. New incoming pre-checkout query. Contains full information about checkout_
- `$poll`: [`Poll`](Poll.md) _Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot_
- `$poll_answer`: [`PollAnswer`](PollAnswer.md) _Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself._

## Methods	
