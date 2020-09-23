<?php

namespace Telegram;

use skrtdev\NovaGram\{dc, conversations};
use skrtdev\Telegram\Type;

class Update extends Type{}
class WebhookInfo extends Type{}
class User extends Type{ use dc; use conversations; }
class Chat extends Type{ use dc; use conversations; }
class Message extends Type{}
class MessageEntity extends Type{}
class PhotoSize extends Type{}
class Animation extends Type{}
class Audio extends Type{}
class Document extends Type{}
class Video extends Type{}
class VideoNote extends Type{}
class Voice extends Type{}
class Contact extends Type{}
class Dice extends Type{}
class PollOption extends Type{}
class PollAnswer extends Type{}
class Poll extends Type{}
class Location extends Type{}
class Venue extends Type{}
class UserProfilePhotos extends Type{}
class File extends Type{}
class ReplyKeyboardMarkup extends Type{}
class KeyboardButton extends Type{}
class KeyboardButtonPollType extends Type{}
class ReplyKeyboardRemove extends Type{}
class InlineKeyboardMarkup extends Type{}
class InlineKeyboardButton extends Type{}
class LoginUrl extends Type{}
class CallbackQuery extends Type{}
class ForceReply extends Type{}
class ChatPhoto extends Type{}
class ChatMember extends Type{}
class ChatPermissions extends Type{}
class BotCommand extends Type{}
class ResponseParameters extends Type{}
class InputMedia extends Type{}
class InputMediaPhoto extends Type{}
class InputMediaVideo extends Type{}
class InputMediaAnimation extends Type{}
class InputMediaAudio extends Type{}
class InputMediaDocument extends Type{}
class InputFile extends Type{}
class Sticker extends Type{}
class StickerSet extends Type{}
class MaskPosition extends Type{}
class InlineQuery extends Type{}
class InlineQueryResult extends Type{}
class InlineQueryResultArticle extends Type{}
class InlineQueryResultPhoto extends Type{}
class InlineQueryResultGif extends Type{}
class InlineQueryResultMpeg4Gif extends Type{}
class InlineQueryResultVideo extends Type{}
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
class InputMessageContent extends Type{}
class InputTextMessageContent extends Type{}
class InputLocationMessageContent extends Type{}
class InputVenueMessageContent extends Type{}
class InputContactMessageContent extends Type{}
class ChosenInlineResult extends Type{}
class LabeledPrice extends Type{}
class Invoice extends Type{}
class ShippingAddress extends Type{}
class OrderInfo extends Type{}
class ShippingOption extends Type{}
class SuccessfulPayment extends Type{}
class ShippingQuery extends Type{}
class PreCheckoutQuery extends Type{}
class PassportData extends Type{}
class PassportFile extends Type{}
class EncryptedPassportElement extends Type{}
class EncryptedCredentials extends Type{}
class PassportElementError extends Type{}
class PassportElementErrorDataField extends Type{}
class PassportElementErrorFrontSide extends Type{}
class PassportElementErrorReverseSide extends Type{}
class PassportElementErrorSelfie extends Type{}
class PassportElementErrorFile extends Type{}
class PassportElementErrorFiles extends Type{}
class PassportElementErrorTranslationFile extends Type{}
class PassportElementErrorTranslationFiles extends Type{}
class PassportElementErrorUnspecified extends Type{}
class Game extends Type{}
class CallbackGame extends Type{}

?>
