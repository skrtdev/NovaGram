# PreCheckoutQuery	

This object contains information about an incoming pre-checkout query.	

## Properties	

- `$id`: _Unique query identifier_
- `$from`: [`User`](User.md) _User who sent the query_
- `$currency`: _Three-letter ISO 4217 currency code_
- `$total_amount`: _Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies)._
- `$invoice_payload`: _Bot specified invoice payload_
- `$shipping_option_id`: _Optional. Identifier of the shipping option chosen by the user_
- `$order_info`: [`OrderInfo`](OrderInfo.md) _Optional. Order info provided by the user_

## Methods	
