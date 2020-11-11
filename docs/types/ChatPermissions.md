# ChatPermissions	

Describes actions that a non-administrator user is allowed to take in a chat.	

## Properties	

- `$can_send_messages`: _Optional. True, if the user is allowed to send text messages, contacts, locations and venues_
- `$can_send_media_messages`: _Optional. True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages_
- `$can_send_polls`: _Optional. True, if the user is allowed to send polls, implies can_send_messages_
- `$can_send_other_messages`: _Optional. True, if the user is allowed to send animations, games, stickers and use inline bots, implies can_send_media_messages_
- `$can_add_web_page_previews`: _Optional. True, if the user is allowed to add web page previews to their messages, implies can_send_media_messages_
- `$can_change_info`: _Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups_
- `$can_invite_users`: _Optional. True, if the user is allowed to invite new users to the chat_
- `$can_pin_messages`: _Optional. True, if the user is allowed to pin messages. Ignored in public supergroups_

## Methods	
