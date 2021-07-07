# WebhookInfo	

Contains information about the current status of a webhook.	

## Properties	

- `$url`: _Webhook URL, may be empty if webhook is not set up_
- `$has_custom_certificate`: _True, if a custom certificate was provided for webhook certificate checks_
- `$pending_update_count`: _Number of updates awaiting delivery_
- `$ip_address`: _Optional. Currently used webhook IP address_
- `$last_error_date`: _Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook_
- `$last_error_message`: _Optional. Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook_
- `$max_connections`: _Optional. Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery_
- `$allowed_updates`: _Optional. A list of update types the bot is subscribed to. Defaults to all update types except chat_member_

