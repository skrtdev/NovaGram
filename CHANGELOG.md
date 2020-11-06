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
        - `addHandler` -> `onUpdate`

## v1.7 - [_Not released yet_](https://github.com/skrtdev/NovaGram/tree/beta)
- [ ] Bot API 5.0
    - [ ] Own Bot API Server
    - [ ] Implement new properties of `getChat`
    - [ ] Implement new `ChatLocation`
    - [ ] Implement new parameter `message_id` of `unpinChatMessage`
    - [ ] Implement new `unpinAllChatMessages`
- [ ] Improved Composer Autoloader (**PSR-4**)
- [ ] Conversations (**full getters**)
- [ ] TTL in Conversations
- [ ] Markdown Entities Parser

## v1.6 - [_Not released yet_](https://github.com/skrtdev/NovaGram/tree/beta)

- [x] Improved Composer Autoloader (**PSR-4**)
- [x] getUpdates (**multi-processing**)
    - [x] Update handler
    - [x] Mode (Webhook/getUpdates/None) is recognized **automatically**
    - [x] Mode (Webhook/getUpdates/None) is recognized **automatically**
    - [x] Auto restart when Bot file is edited (optional)

- [x] Many **new Exceptions** (e.g. `ForbiddenException`, `BadRequestException`)
- [x] Error Handlers
- [x] Changed behaviour of settings' `debug` parameter: now it creates an Error Handler  
- [x] Some improvements to Prototypes

    > `$this` inside prototype now refers to the Object, so that `$self` is no longer needed

- [x] Fixed many bugs in HTML Entities Parser

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
