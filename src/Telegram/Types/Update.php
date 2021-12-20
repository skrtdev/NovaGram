<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents an incoming update.At most one of the optional parameters can be present in any given update.
*/
class Update extends Type{
    
    /** @var int The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you're using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially. */
    public int $update_id;

    /** @var Message|null New incoming message of any kind — text, photo, sticker, etc. */
    public ?Message $message = null;

    /** @var Message|null New version of a message that is known to the bot and was edited */
    public ?Message $edited_message = null;

    /** @var Message|null New incoming channel post of any kind — text, photo, sticker, etc. */
    public ?Message $channel_post = null;

    /** @var Message|null New version of a channel post that is known to the bot and was edited */
    public ?Message $edited_channel_post = null;

    /** @var InlineQuery|null New incoming inline query */
    public ?InlineQuery $inline_query = null;

    /** @var ChosenInlineResult|null The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot. */
    public ?ChosenInlineResult $chosen_inline_result = null;

    /** @var CallbackQuery|null New incoming callback query */
    public ?CallbackQuery $callback_query = null;

    /** @var ShippingQuery|null New incoming shipping query. Only for invoices with flexible price */
    public ?ShippingQuery $shipping_query = null;

    /** @var PreCheckoutQuery|null New incoming pre-checkout query. Contains full information about checkout */
    public ?PreCheckoutQuery $pre_checkout_query = null;

    /** @var Poll|null New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot */
    public ?Poll $poll = null;

    /** @var PollAnswer|null A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself. */
    public ?PollAnswer $poll_answer = null;

    /** @var ChatMemberUpdated|null The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user. */
    public ?ChatMemberUpdated $my_chat_member = null;

    /** @var ChatMemberUpdated|null A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates. */
    public ?ChatMemberUpdated $chat_member = null;

    /** @var ChatJoinRequest|null A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates. */
    public ?ChatJoinRequest $chat_join_request = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->update_id = $array['update_id'];
        $this->message = isset($array['message']) ? new Message($array['message'], $Bot) : null;
        $this->edited_message = isset($array['edited_message']) ? new Message($array['edited_message'], $Bot) : null;
        $this->channel_post = isset($array['channel_post']) ? new Message($array['channel_post'], $Bot) : null;
        $this->edited_channel_post = isset($array['edited_channel_post']) ? new Message($array['edited_channel_post'], $Bot) : null;
        $this->inline_query = isset($array['inline_query']) ? new InlineQuery($array['inline_query'], $Bot) : null;
        $this->chosen_inline_result = isset($array['chosen_inline_result']) ? new ChosenInlineResult($array['chosen_inline_result'], $Bot) : null;
        $this->callback_query = isset($array['callback_query']) ? new CallbackQuery($array['callback_query'], $Bot) : null;
        $this->shipping_query = isset($array['shipping_query']) ? new ShippingQuery($array['shipping_query'], $Bot) : null;
        $this->pre_checkout_query = isset($array['pre_checkout_query']) ? new PreCheckoutQuery($array['pre_checkout_query'], $Bot) : null;
        $this->poll = isset($array['poll']) ? new Poll($array['poll'], $Bot) : null;
        $this->poll_answer = isset($array['poll_answer']) ? new PollAnswer($array['poll_answer'], $Bot) : null;
        $this->my_chat_member = isset($array['my_chat_member']) ? new ChatMemberUpdated($array['my_chat_member'], $Bot) : null;
        $this->chat_member = isset($array['chat_member']) ? new ChatMemberUpdated($array['chat_member'], $Bot) : null;
        $this->chat_join_request = isset($array['chat_join_request']) ? new ChatJoinRequest($array['chat_join_request'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
