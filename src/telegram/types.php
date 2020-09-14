<?php

namespace Telegram;





class Message extends Type{}
class Update extends Type{}
class InlineQuery extends Type{}
class ChosenInlineResult extends Type{}
class CallbackQuery extends Type{}
class ShippingQuery extends Type{}
class PreCheckoutQuery extends Type{}
class Poll extends Type{}
class PollAnswer extends Type{}
class ChatPhoto extends Type{}
class Chat extends Type{ use \NovaGram\dc; use \NovaGram\conversations; }
class ChatPermissions extends Type{}
class User extends Type{ use \NovaGram\dc; use \NovaGram\conversations; }
class MessageEntity extends Type{}
class Animation extends Type{}
class Audio extends Type{}
class Document extends Type{}
class PhotoSize extends Type{}
class Sticker extends Type{}
class Video extends Type{}
class VideoNote extends Type{}
class Voice extends Type{}
class Contact extends Type{}
class Dice extends Type{}
class Game extends Type{}
class Venue extends Type{}
class Location extends Type{}
class Invoice extends Type{}
class SuccessfulPayment extends Type{}
class PassportData extends Type{}
class InlineKeyboardMarkup extends Type{}
class PollOption extends Type{}
class ProfilePhoto extends Type{}
class UserProfilePhotos extends Type{}
class KeyboardButton extends Type{}
class ReplyKeyboardMarkup extends Type{}
class KeyboardButtonPollType extends Type{}
class InlineKeyboard extends Type{}
class LoginUrl extends Type{}
class InlineKeyboardButton extends Type{}
class CallbackGame extends Type{}
class ChatMember extends Type{}
class InputFile extends Type{}
class InputMediaVideo extends Type{}
class InputMediaAnimation extends Type{}
class InputMediaAudio extends Type{}
class InputMediaDocument extends Type{}
class MaskPosition extends Type{}
class StickerSet extends Type{}
class InputMessageContent extends Type{}
class InlineQueryResultArticle extends Type{}
class InlineQueryResultPhoto extends Type{}
class InlineQueryResultGif extends Type{}
class InlineQueryResultMpeg4Gif extends Type{}
class InlineQueryResultAudio extends Type{}
class InlineQueryResultVoice extends Type{}
class InlineQueryResultDocument extends Type{}
class InlineQueryResultLocation extends Type{}
class InlineQueryResultVenue extends Type{}
class InlineQueryResultContact extends Type{}
class InlineQueryResultGame extends Type{}
class InlineQueryResultCachedPhoto extends Type{}
class InlineQueryResultCachedGif extends Type{}
class InlineQueryResultCachedMpeg4Gif extends Type{}
class InlineQueryResultCachedSticker extends Type{}
class InlineQueryResultCachedDocument extends Type{}
class InlineQueryResultCachedVideo extends Type{}
class InlineQueryResultCachedVoice extends Type{}
class InlineQueryResultCachedAudio extends Type{}
class ShippingAddress extends Type{}
class OrderInfo extends Type{}
class LabeledPrice extends Type{}
class ShippingOption extends Type{}
class GameHighScore extends Type{}
class InlineKeyboardRow extends Type{}

?>
