# ChatMemberUpdated	

This object represents changes in the status of a chat member.	

## Properties	

- `$chat`: [`Chat`](Chat.md) _Chat the user belongs to_
- `$from`: [`User`](User.md) _Performer of the action, which resulted in the change_
- `$date`: _Date the change was done in Unix time_
- `$old_chat_member`: [`ChatMember`](ChatMember.md) _Previous information about the chat member_
- `$new_chat_member`: [`ChatMember`](ChatMember.md) _New information about the chat member_
- `$invite_link`: [`ChatInviteLink`](ChatInviteLink.md) _Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only._

