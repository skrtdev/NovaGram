# ChatInviteLink	

Represents an invite link for a chat.	

## Properties	

- `$invite_link`: _The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”._
- `$creator`: [`User`](User.md) _Creator of the link_
- `$is_primary`: _True, if the link is primary_
- `$is_revoked`: _True, if the link is revoked_
- `$expire_date`: _Optional. Point in time (Unix timestamp) when the link will expire or has been expired_
- `$member_limit`: _Optional. Maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999_

