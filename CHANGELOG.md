# CHANGELOG

## v1.4 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.4)

- Added **Typed Properties** with Description to every Object
- Added non-dinamic Methods to Bot Class
- Added **positional arguments** and **named arguments** (like `python kwargs`) to Bot Methods (in a BC way)

    > Check [updated docs](https://docs.novagram.ga/requests.html)

- Added Entities Parser, and Message::toHTML() Method

## v1.5 - [Source Code](https://github.com/skrtdev/NovaGram/releases/tag/v1.5)

- Added **positional arguments** and **named arguments** (like `python kwargs`) to Types Methods (in a BC way)

    > Check [updated docs](https://docs.novagram.ga/objects.html)

- Bot and Database Classes are now prototypeable

    > Learn more about prototypes [here](https://docs.novagram.ga/prototypes.html)

- Full Return Types implementation
- Added some HTML tags to Entities Parser

    > Message::toHTML() is now removed in favor of Message::getHTMLText()

- Built-in debug now looks like a normal exception
- `NULL` properties aren no longer displayed in debug functions (such as `var_dump`, `print_r` and similar)
- Updated docs

## v1.5.1 - Bug Fix Release

- Fixed a bug with Prototypes and Objects

    > Prototypes Methods couldn't be added directly to objects


## v1.6 - _not released yet_

- getUpdates mode (async handlers)
- Conversations (full getters)
- Some improvements to Prototypes

    > `$this` inside prototype now refers to the Object, so that `$self` is no longer needed

- Markdown Entities Parser
