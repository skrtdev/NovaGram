# CHANGELOG

> Upcoming in v2: Support for PostegreSQL and TTL in Conversations  


# v2.0

- Deprecations
  - Classes
    - `TelegramBot`
    - `Telegram\Bot`
    - `NovaGram\Bot`
    - `Telegram\*` Types
  - Bot Class
    - Settings
      - `disable_webhook` parameter (in favor of `Bot::NONE` mode)
      - `getUpdates` mode (in favor of `Bot::CLI` mode)
      - `webhook` mode (in favor of `Bot::WEBHOOK` mode)
- New Features
  - Filters
  - New database system --


## v1.10
- Update to [**Bot API v5.2**](https://core.telegram.org/bots/api#april-26-2021).  
- Fixed crash when `pcntl` is not available.  
- Webhook is now automatically set.  
- Fixed `restart_on_changes` with spaces inside file path.  
- Improved regex handlers: regex will no longer be used on handlers with exact match conditions.  

## v1.9 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.9)  
- New **User mode**: you can now run userbots with NovaGram using [tdlight-telegram-bot-api](https://github.com/tdlight-team/tdlight-telegram-bot-api). (**Webhooks too!**) Check out [this example](https://github.com/skrtdev/NovaGram/blob/master/examples/userbot.php).    
- **Bot API v5.1**:
    > Check [full changelog](https://core.telegram.org/bots/api#march-9-2021) for more info  

    - New types: `ChatMemberUpdated`, `ChatInviteLink`, `VoiceChatStarted`, `VoiceChatEnded`, `VoiceChatParticipantsInvited`, `MessageAutoDeleteTimerChanged`.  
    - New methods: `createChatInviteLink`, `editChatInviteLink`, `revokeChatInviteLink`.  
    - New handlers: `onMyChatMember`, `onChatMember`.  
- New **Features**:  
    - New `onCallbackData` handler: similar to `onText` but for Callback Queries data.  
    - New `onNewChatMember` and `onNewGroup` handlers: check [updated docs](https://docs.novagram.ga/handling.html).  
    - New `exportCommands` method, that calls `setMyCommands` with the registered command handlers (`onCommand()`). Automatically called by default on CLI
    - `restart_on_changes` has been improved: now it uses `pcntl_exec` when possible (instead of `shell_exec`)  
    - Added `User::getMention()`: it generates a clickable link for that User.  
    - Added new Class Handlers: `CommandHandler` and `CallbackHandler`  
    - Added `toArray()` and `toJSON()` methods to `ObjectsList` and `Type` objects  
    - Added `ObjectsList::getLast()`, useful if you work with photos, which are arrays of `PhotoSize`s  
    - Added autoload of class handlers: it will include and fire all handlers found by searching for files that ends with `Handler.php`, `Command.php` and `Callback.php`. Class names must be the same as file names. It won't look inside `vendor`.  
    - Now `Message::editText()` will not delete `reply_markup` by default. Use `reply_markup: null` to force deleting it.  
    - Added `Dispatcher::stopHandling()` or simply `stop_handling()`, which stop other handlers from being executed (previously, `exit()` was needed)  
    - Added `Database::getConversationsByName()`
- New Bot settings:  
    - `username`: Bot username, needed to avoid that other bot's commands are recognized in groups when using command handlers and webhook.  
    - `export_commands`: Whether to call `Bot::exportCommands()` when idling on CLI. Default to `true`  
    - `include_classes`: Whether to automatically include and fire Commands Class Handlers (includes all files that ends with `Command.php`, `Handler.php`, and `Callback.php` inside the main script directory). Defualt value is `true` on `CLI` and `false` on `Webhook`.  
    - `workers`: Maximum amount of processes that will run simultaneously. (`CLI` only)  
    - `skip_old_updates`: Whether to not process updates sent before starting the bot.  
- New Exceptions:  
    - `NotFoundException` (404)  
    - `MethodNotAllowedException` (405)  
    - `RequestEntityTooLargeException` (413)  
- Fixes:  
    - Bot won't crash on uncaught internal exceptions.  
    - Conversations are now updated instead of deleted and reinserted.  
    - Classes `MessageId`, `ProximityAlertTriggered` didn't work properly  
    - Bot will now process queued updates before retrieving other ones  
    - Fixed wrong behaviour when serializing false  
    - Default values for `log_updates` and `debug` are now `null` instead of `false`.  
    - Now `log_updates` setting works on getUpdates too  
    - `setMyCommands` arguments were wrong  
    - Errors weren't handled when thrown inside class handlers  
    - Unknown objects are now instances of `stdClass` or `ObjectsList`  
    - Exceptions constructor argument `$previous_exception` was an `Exception` instead of a `Throwable`  
    - Entities parser didn't work with `ObjectsList`  
    - Some databases couldn't be used with `getUpdates`, fixed  
    - `onCommand` handler `$args` argument behaviour was incorrect  
- Minor:
    - Added `CurlException`  
    - Renamed `Bot::idle()` to `Bot::start()`  
    - You can now use PHP8 `named arguments` in Bot constructor instead of the `$settings` array  
    - `JSON` all all the related methods are now static in Bot, this makes faster using multiple bot instances  
    - Now when using `getUpdates` process titles are customized in order to differenciate main process and child processes  
    - Properties `User::dc_id` and `Message::html` are now cached  
    - All the Objects are now serializable  
    - Added `$description` parameter to `onCommand`  
    - Improvements in `Prototypes`: `isPrototypeable` is now cached  


## v1.8 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.8)
- New handlers: `onTextMessage`, `onText`, and `onCommand`
- New Bot settings:
    - `command_prefixes`: Array of characters for commands prefixes. e.g. `/start`, `.info`
    - `group_handlers`: Whether to execute all the handlers of an update in the same process (`true`), or fork a process for each handler (`false`)
    - `wait_handlers`: Whether to wait for handlers to finish when closing script
    - `threshold`: Amount of max seconds the script will sleep instead of throwing a `TooManyRequestsException`. Defaults to 10 when using `getUpdates`  
    - `only_if_banned`: Default value for `only_if_banned` parameter in `unbanChatMember` method  
- Conversations **full getters**
    - `getConversationsByChat` (`User|Chat::getConversations()`)
    - `getConversationsByValue`
- `amphp` has been removed, now [skrtdev/async](https://github.com/skrtdev/php-async) is used in classes too
- Added all class handlers: `onMessage`, `onEditedMessage`, `onChannelPost`, etc
    - `allowed_updates` is automatically generated from classes too
    - `$this->Bot` can be used to get `Bot` instance inside Class handlers
    - More classes can be handled in a single `handleClass` call  
- Now when using `getUpdates` bot won't crash on `BadGatewayException`s, it will retry to connect every second instead
- Now `var_dump` is used instead of `print_r` in `debug` functions  
- Now list of Objects are instances of `ObjectsList` rather than instances of `stdClass`  
- You can now use PHP8 `named arguments` instead of the `$args` array in both `Bot` and `Objects` methods  
- A custom `PDO` instance can now be used as database. Pass it in the database Bot setting instead of the Database array (`novagram` will be used as prefix)
- `Exception::$response_parameters` is now an instance of `ResponseParameters` or null
- Return types of every method has been updated  
- Now a warning is emitted when using getUpdates if a webhook url is set

## v1.7 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.7)
- Improved performances of [skrtdev/async](https://github.com/skrtdev/php-async)
- Bot API 5.0
    - **Own Bot API Server**: added new `bot_api_url` parameter to bot settings
    - Added `allow_sending_without_reply` global parameter to bot settings
    - Updated **all** objects and methods
    - Added the new [ChatLocation](https://core.telegram.org/bots/api#chatlocation) Object
    - Added all new Methods
        - [logOut](https://core.telegram.org/bots/api#logout)
        - [close](https://core.telegram.org/bots/api#close)
        - [unpinAllChatMessages](https://core.telegram.org/bots/api#unpinallchatmessages)
- New Exception: `UnauthorizedException` (401)
- `allowed_updates` is automatically generated when using _getUpdates_, so bot is faster if it receives many unwanted updates
- Improved Composer Autoloader (**PSR-4**)

## v1.6.1 - [Bug Fix Release](https://github.com/skrtdev/NovaGram/releases/tag/v1.6.1)

- Fixed a bug that affected webhook


## v1.6 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.6)

- Improved Composer Autoloader (**PSR-4**)
- Added **getUpdates** mode (_multi-processing_)
    - New `Dispatcher` class
    - Mode (Webhook/getUpdates/None) is recognized **automatically**
    - Optional async handling of updates
    - Closure Handlers ([skrtdev/async](https://github.com/skrtdev/php-async))
        - Full handlers (onUpdate, onMessage, onCallbackQuery, etc.)
        - Error handler
    - Class Handlers ([amphp/amp](https://github.com/amphp/amp))
        - Only Update handler
    - Auto restart when Bot file is edited (optional)

- Many **new Exceptions**
    - `BadRequestException` (400)
    - `ForbiddenException` (403)
    - `ConflictException` (409)
    - `TooManyRequestsException` (429)
    - `BadGatewayException` (502) (yes, sometimes it happens)

- Changes in Bot settings
    - Changed behaviour of settings' `debug` parameter: now it creates an Error Handler  
    - `async`: Concurrent handling of updates
    - `restart_on_changes`: Auto restart when Bot file is edited (optional)  
    - `logger`: `Monolog\Logger` constant for logging

- Now you can pass your custom `Monolog\Logger`, as the 3rd parameter of the Bot constructor  
- Some improvements to Prototypes

    > `$this` inside prototype now refers to the Object, so that `$self` is no longer needed

- Fixed many bugs in HTML Entities Parser

## v1.5.1 - [Bug Fix Release](https://github.com/skrtdev/NovaGram/releases/tag/v1.5.1)

- Fixed a bug with Prototypes and Objects

    > Prototypes Methods couldn't be added directly to objects

## v1.5 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.5)

- Added **positional arguments** and **named arguments** (like `python kwargs`) to Types Methods (in a BC way)

    > Check [updated docs](https://docs.novagram.ga/objects.html)

- Bot and Database Classes are now prototypeable

    > Learn more about prototypes [here](https://docs.novagram.ga/prototypes.html)

- Full Return Types implementation
- Added some HTML tags to Entities Parser

    > Message::toHTML() is now removed in favor of Message::getHTMLText()

- Built-in debug now looks like a normal exception
- `NULL` properties are no longer displayed in debug functions (such as `var_dump`, `print_r` and similar)
- Updated docs

## v1.4 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.4)

- Added **Typed Properties** with Description to every Object
- Added non-dynamic Methods to Bot Class
- Added **positional arguments** and **named arguments** (like `python kwargs`) to Bot Methods (in a BC way)

    > Check [updated docs](https://docs.novagram.ga/requests.html)

- Added Entities Parser, and Message::toHTML() Method
