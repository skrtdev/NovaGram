<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents the content of an invoice message to be sent as the result of an inline query.
*/
class InputInvoiceMessageContent extends Type{
    
    /** @var string Product name, 1-32 characters */
    public string $title;

    /** @var string Product description, 1-255 characters */
    public string $description;

    /** @var string Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes. */
    public string $payload;

    /** @var string Payment provider token, obtained via Botfather */
    public string $provider_token;

    /** @var string Three-letter ISO 4217 currency code, see more on currencies */
    public string $currency;

    /** @var ObjectsList Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.) */
    public ObjectsList $prices;

    /** @var int|null The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0 */
    public ?int $max_tip_amount = null;

    /** @var ObjectsList|null A JSON-serialized array of suggested amounts of tip in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount. */
    public ?ObjectsList $suggested_tip_amounts = null;

    /** @var string|null A JSON-serialized object for data about the invoice, which will be shared with the payment provider. A detailed description of the required fields should be provided by the payment provider. */
    public ?string $provider_data = null;

    /** @var string|null URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for. */
    public ?string $photo_url = null;

    /** @var int|null Photo size */
    public ?int $photo_size = null;

    /** @var int|null Photo width */
    public ?int $photo_width = null;

    /** @var int|null Photo height */
    public ?int $photo_height = null;

    /** @var bool|null Pass True, if you require the user's full name to complete the order */
    public ?bool $need_name = null;

    /** @var bool|null Pass True, if you require the user's phone number to complete the order */
    public ?bool $need_phone_number = null;

    /** @var bool|null Pass True, if you require the user's email address to complete the order */
    public ?bool $need_email = null;

    /** @var bool|null Pass True, if you require the user's shipping address to complete the order */
    public ?bool $need_shipping_address = null;

    /** @var bool|null Pass True, if user's phone number should be sent to provider */
    public ?bool $send_phone_number_to_provider = null;

    /** @var bool|null Pass True, if user's email address should be sent to provider */
    public ?bool $send_email_to_provider = null;

    /** @var bool|null Pass True, if the final price depends on the shipping method */
    public ?bool $is_flexible = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->title = $array['title'];
        $this->description = $array['description'];
        $this->payload = $array['payload'];
        $this->provider_token = $array['provider_token'];
        $this->currency = $array['currency'];
        $this->prices = new ObjectsList(iterate($array['prices'], fn($item) => new LabeledPrice($item, $Bot)));
        $this->max_tip_amount = $array['max_tip_amount'] ?? null;
        $this->suggested_tip_amounts = isset($array['suggested_tip_amounts']) ? new ObjectsList($array['suggested_tip_amounts']) : null;
        $this->provider_data = $array['provider_data'] ?? null;
        $this->photo_url = $array['photo_url'] ?? null;
        $this->photo_size = $array['photo_size'] ?? null;
        $this->photo_width = $array['photo_width'] ?? null;
        $this->photo_height = $array['photo_height'] ?? null;
        $this->need_name = $array['need_name'] ?? null;
        $this->need_phone_number = $array['need_phone_number'] ?? null;
        $this->need_email = $array['need_email'] ?? null;
        $this->need_shipping_address = $array['need_shipping_address'] ?? null;
        $this->send_phone_number_to_provider = $array['send_phone_number_to_provider'] ?? null;
        $this->send_email_to_provider = $array['send_email_to_provider'] ?? null;
        $this->is_flexible = $array['is_flexible'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
