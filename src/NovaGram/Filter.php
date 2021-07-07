<?php


namespace skrtdev\NovaGram;

use Attribute;
use skrtdev\Telegram\{CallbackQuery, Chat, InlineQuery, Message, User};
use JetBrains\PhpStorm\{ArrayShape, Pure};

#[Attribute(Attribute::TARGET_FUNCTION | Attribute::IS_REPEATABLE)]
class Filter implements FilterInterface {

    /**
     * Filter constructor.
     * @param array|int|null $user User id or array of user ids of message, callback query, and inline query sender
     * @param array|int|null $chat Chat id or array of chat ids of message and callback query chat
     * @param array|string|null $language_code Language code or array of language codes. Won't be triggered if a language code isn't sent by bot api
     * @param bool|null $is_private Will handle private chats only. Messages, callback and inline queries allowed
     * @param bool|null $is_group Will handle group and supergroups. Messages, callback and inline queries allowed
     * @param bool|null $is_channel Only for callback and inline queries, as sent channel messages are retrievable using onChannelPost handler
     * @param bool|null $is_reply Will handle messages which are a reply to another message. Can work with callback queries too, even if it is discouraged
     * @param bool|null $is_forwarded Will handle messages which are forwarded. Can work with callback queries too, even if it is discouraged
     * @param bool|null $is_photo Will handle messages which are a photo. Can work with callback queries too, even if it is discouraged
     * @param bool|null $is_inline Will handle messages which are sent using an inline bot. Works with callback queries too
     */
    public function __construct(
        protected array|int|null $user = null,
        protected array|int|null $chat = null,
        protected array|string|null $language_code = null,
        protected ?bool $is_private = null,
        protected ?bool $is_group = null,
        protected ?bool $is_channel = null,
        protected ?bool $is_reply = null,
        protected ?bool $is_forwarded = null,
        protected ?bool $is_photo = null,
        protected ?bool $is_inline = null
    ){
        if(is_int($this->user)){
            $this->user = [$this->user];
        }
        if(is_int($this->chat)){
            $this->chat = [$this->chat];
        }
        if(is_string($this->language_code)){
            $this->language_code = [$this->language_code];
        }
    }

    #[Pure]
    #[ArrayShape([Message::class, Chat::class, 'string', User::class])]
    public static function normalizeObject(Message|InlineQuery|CallbackQuery $object): array
    {
        if($object instanceof Message){
            $message = $object;
            $chat = $message->chat;
            $chat_type = $chat->type;
            $user = $message->from ?? null;
        }
        elseif($object instanceof InlineQuery){
            $user = $object->from;
            $chat_type = $object->chat_type;
        }
        else{ // CallbackQuery
            /** @var CallbackQuery $object */
            $user = $object->from;
            $message = $object->message;
            $chat = $message->chat;
            $chat_type = $chat->type;
        }
        return [$message ?? null, $chat ?? null, $chat_type, $user];
    }

    #[Pure]
    public function handle(Message|InlineQuery|CallbackQuery $object): bool
    {
        #var_dump($this);
        /** @var Message|null $message */
        /** @var Chat|null $chat */
        /** @var string $chat_type */
        /** @var User|null $user */
        [$message, $chat, $chat_type, $user] = self::normalizeObject($object); // FIXME delete docblocks when PHPStorm will recognize array destructuring
        return
            (!isset($this->user) || in_array($user?->id, $this->user)) &&
            (!isset($this->chat) || in_array($chat?->id, $this->chat)) &&
            (!isset($this->language_code) || in_array($user?->language_code ?? null, $this->language_code)) &&
            (!isset($this->is_private) || $this->is_private === in_array($chat_type, ['private', 'sender'])) &&
            (!isset($this->is_group) || $this->is_group === in_array($chat_type, ['group', 'supergroup'])) &&
            (!isset($this->is_reply) || $this->is_reply === isset($message->reply_to_message)) &&
            (!isset($this->is_forwarded) || $this->is_forwarded === isset($message->forward_date)) &&
            (!isset($this->is_photo) || $this->is_photo === isset($message->photo)) &&
            (!isset($this->is_inline) || $this->is_inline === isset($message->via_bot))
        ;
    }

    #[Pure]
    public function isAllowedUpdate(string $update_type): bool
    {
        return in_array($update_type, ['message', 'edited_message', 'channel_post', 'edited_channel_post', 'inline_query', 'callback_query']);
    }
}