<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\{dc, conversations};


class Message extends \Telegram\Message{}
class Update extends \Telegram\Update{}
class InlineQuery extends \Telegram\InlineQuery{}
class ChosenInlineResult extends \Telegram\ChosenInlineResult{}
class CallbackQuery extends \Telegram\CallbackQuery{}
class ShippingQuery extends \Telegram\ShippingQuery{}
class PreCheckoutQuery extends \Telegram\PreCheckoutQuery{}
class Poll extends \Telegram\Poll{}
class PollAnswer extends \Telegram\PollAnswer{}
class ChatPhoto extends \Telegram\ChatPhoto{}
class Chat extends \Telegram\Chat{ use dc; use conversations; }
class ChatPermissions extends \Telegram\ChatPermissions{}
class User extends \Telegram\User{ use dc; use conversations; }
class MessageEntity extends \Telegram\MessageEntity{}
class Animation extends \Telegram\Animation{}
class Audio extends \Telegram\Audio{}
class Document extends \Telegram\Document{}
class PhotoSize extends \Telegram\PhotoSize{}
class Sticker extends \Telegram\Sticker{}
class Video extends \Telegram\Video{}
class VideoNote extends \Telegram\VideoNote{}
class Voice extends \Telegram\Voice{}
class Contact extends \Telegram\Contact{}
class Dice extends \Telegram\Dice{}
class Game extends \Telegram\Game{}
class Venue extends \Telegram\Venue{}
class Location extends \Telegram\Location{}
class Invoice extends \Telegram\Invoice{}
class SuccessfulPayment extends \Telegram\SuccessfulPayment{}
class PassportData extends \Telegram\PassportData{}
class InlineKeyboardMarkup extends \Telegram\InlineKeyboardMarkup{}
class PollOption extends \Telegram\PollOption{}
class ProfilePhoto extends \Telegram\ProfilePhoto{}
class UserProfilePhotos extends \Telegram\UserProfilePhotos{}
class KeyboardButton extends \Telegram\KeyboardButton{}
class ReplyKeyboardMarkup extends \Telegram\ReplyKeyboardMarkup{}
class KeyboardButtonPollType extends \Telegram\KeyboardButtonPollType{}
class InlineKeyboard extends \Telegram\InlineKeyboard{}
class LoginUrl extends \Telegram\LoginUrl{}
class InlineKeyboardButton extends \Telegram\InlineKeyboardButton{}
class CallbackGame extends \Telegram\CallbackGame{}
class ChatMember extends \Telegram\ChatMember{}
class InputFile extends \Telegram\InputFile{}
class InputMediaVideo extends \Telegram\InputMediaVideo{}
class InputMediaAnimation extends \Telegram\InputMediaAnimation{}
class InputMediaAudio extends \Telegram\InputMediaAudio{}
class InputMediaDocument extends \Telegram\InputMediaDocument{}
class MaskPosition extends \Telegram\MaskPosition{}
class StickerSet extends \Telegram\StickerSet{}
class InputMessageContent extends \Telegram\InputMessageContent{}
class InlineQueryResultArticle extends \Telegram\InlineQueryResultArticle{}
class InlineQueryResultPhoto extends \Telegram\InlineQueryResultPhoto{}
class InlineQueryResultGif extends \Telegram\InlineQueryResultGif{}
class InlineQueryResultMpeg4Gif extends \Telegram\InlineQueryResultMpeg4Gif{}
class InlineQueryResultAudio extends \Telegram\InlineQueryResultAudio{}
class InlineQueryResultVoice extends \Telegram\InlineQueryResultVoice{}
class InlineQueryResultDocument extends \Telegram\InlineQueryResultDocument{}
class InlineQueryResultLocation extends \Telegram\InlineQueryResultLocation{}
class InlineQueryResultVenue extends \Telegram\InlineQueryResultVenue{}
class InlineQueryResultContact extends \Telegram\InlineQueryResultContact{}
class InlineQueryResultGame extends \Telegram\InlineQueryResultGame{}
class InlineQueryResultCachedPhoto extends \Telegram\InlineQueryResultCachedPhoto{}
class InlineQueryResultCachedGif extends \Telegram\InlineQueryResultCachedGif{}
class InlineQueryResultCachedMpeg4Gif extends \Telegram\InlineQueryResultCachedMpeg4Gif{}
class InlineQueryResultCachedSticker extends \Telegram\InlineQueryResultCachedSticker{}
class InlineQueryResultCachedDocument extends \Telegram\InlineQueryResultCachedDocument{}
class InlineQueryResultCachedVideo extends \Telegram\InlineQueryResultCachedVideo{}
class InlineQueryResultCachedVoice extends \Telegram\InlineQueryResultCachedVoice{}
class InlineQueryResultCachedAudio extends \Telegram\InlineQueryResultCachedAudio{}
class ShippingAddress extends \Telegram\ShippingAddress{}
class OrderInfo extends \Telegram\OrderInfo{}
class LabeledPrice extends \Telegram\LabeledPrice{}
class ShippingOption extends \Telegram\ShippingOption{}
class GameHighScore extends \Telegram\GameHighScore{}
class InlineKeyboardRow extends \Telegram\InlineKeyboardRow{}

?>
