# CHANGELOG

## v2.0 - _Future Deprecations_

- Classes
    - `TelegramBot`
    - `Telegram\Bot`
    - `NovaGram\Bot`
    - `Telegram\*` Types
- Bot Class
    - Settings
        - `disable_webhook` parameter
        - `getUpdates` mode
        - `webhook` mode
    - Methods
        - `setErrorHandler` -> `addErrorHandler`

## v1.7 - [_Not released yet_](https://github.com/skrtdev/NovaGram/tree/beta)
- [ ] Use amp in Closures?
- [ ] Bot API 5.0
    - [ ] Own Bot API Server
    - [ ] Implement new properties of `Chat` Object
    - [ ] Implement new `ChatLocation` Object
    - [ ] Implement new parameter `message_id` of `unpinChatMessage` Method
    - [ ] Implement new `unpinAllChatMessages` Method
- [ ] New more specific Exceptions
- [ ] Improved Composer Autoloader (**PSR-4**)
- [ ] Conversations (**full getters**)
- [ ] TTL in Conversations
- [ ] Markdown Entities Parser

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
    - `BadRequestException`
    - `ForbiddenException`
    - `ConflictException`
    - `TooManyRequestsException`
    - `BadGatewayException` (yes, sometimes it happens)

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
- Added non-dinamic Methods to Bot Class
- Added **positional arguments** and **named arguments** (like `python kwargs`) to Bot Methods (in a BC way)

    > Check [updated docs](https://docs.novagram.ga/requests.html)

- Added Entities Parser, and Message::toHTML() Method
