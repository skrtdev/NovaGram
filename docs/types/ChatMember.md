# ChatMember	

This object contains information about one member of a chat.	

## Properties	

- `$user`: [`User`](User.md) _Information about the user_
- `$status`: _The member's status in the chat. Can be “creator”, “administrator”, “member”, “restricted”, “left” or “kicked”_
- `$custom_title`: _Optional. Owner and administrators only. Custom title for this user_
- `$is_anonymous`: _Optional. Owner and administrators only. True, if the user's presence in the chat is hidden_
- `$can_be_edited`: _Optional. Administrators only. True, if the bot is allowed to edit administrator privileges of that user_
- `$can_post_messages`: _Optional. Administrators only. True, if the administrator can post in the channel; channels only_
- `$can_edit_messages`: _Optional. Administrators only. True, if the administrator can edit messages of other users and can pin messages; channels only_
- `$can_delete_messages`: _Optional. Administrators only. True, if the administrator can delete messages of other users_
- `$can_restrict_members`: _Optional. Administrators only. True, if the administrator can restrict, ban or unban chat members_
- `$can_promote_members`: _Optional. Administrators only. True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)_
- `$can_change_info`: _Optional. Administrators and restricted only. True, if the user is allowed to change the chat title, photo and other settings_
- `$can_invite_users`: _Optional. Administrators and restricted only. True, if the user is allowed to invite new users to the chat_
- `$can_pin_messages`: _Optional. Administrators and restricted only. True, if the user is allowed to pin messages; groups and supergroups only_
- `$is_member`: _Optional. Restricted only. True, if the user is a member of the chat at the moment of the request_
- `$can_send_messages`: _Optional. Restricted only. True, if the user is allowed to send text messages, contacts, locations and venues_
- `$can_send_media_messages`: _Optional. Restricted only. True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes_
- `$can_send_polls`: _Optional. Restricted only. True, if the user is allowed to send polls_
- `$can_send_other_messages`: _Optional. Restricted only. True, if the user is allowed to send animations, games, stickers and use inline bots_
- `$can_add_web_page_previews`: _Optional. Restricted only. True, if the user is allowed to add web page previews to their messages_
- `$until_date`: _Optional. Restricted and kicked only. Date when restrictions will be lifted for this user; unix time_

## Methods	
