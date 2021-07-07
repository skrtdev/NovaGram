# InputInvoiceMessageContent	

Represents the content of an invoice message to be sent as the result of an inline query.	

## Properties	

- `$title`: _Product name, 1-32 characters_
- `$description`: _Product description, 1-255 characters_
- `$payload`: _Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes._
- `$provider_token`: _Payment provider token, obtained via Botfather_
- `$currency`: _Three-letter ISO 4217 currency code, see more on currencies_
- `$prices`: [`Array of LabeledPrice`](LabeledPrice.md) _Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)_
- `$max_tip_amount`: _Optional. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0_
- `$suggested_tip_amounts`: _Optional. A JSON-serialized array of suggested amounts of tip in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount._
- `$provider_data`: _Optional. A JSON-serialized object for data about the invoice, which will be shared with the payment provider. A detailed description of the required fields should be provided by the payment provider._
- `$photo_url`: _Optional. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for._
- `$photo_size`: _Optional. Photo size_
- `$photo_width`: _Optional. Photo width_
- `$photo_height`: _Optional. Photo height_
- `$need_name`: _Optional. Pass True, if you require the user's full name to complete the order_
- `$need_phone_number`: _Optional. Pass True, if you require the user's phone number to complete the order_
- `$need_email`: _Optional. Pass True, if you require the user's email address to complete the order_
- `$need_shipping_address`: _Optional. Pass True, if you require the user's shipping address to complete the order_
- `$send_phone_number_to_provider`: _Optional. Pass True, if user's phone number should be sent to provider_
- `$send_email_to_provider`: _Optional. Pass True, if user's email address should be sent to provider_
- `$is_flexible`: _Optional. Pass True, if the final price depends on the shipping method_

