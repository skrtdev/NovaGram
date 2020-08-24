# NovaGram
An elegant, Object-Oriented, reliable PHP Telegram Bot Interface

## Features

- All the Methods and Types implemented in Bot Api as of August 2020.
- Exactly like Bot Api (so you don't really need documentation)
- [JSON Payload](https://docs.novagram.ga/construct.html#json-payload) implementation, for a faster Bot.
- Auto JSON-Encode in parameters that require it (when passing an array)
- [Object Methods](https://docs.novagram.ga/objects.html) for a smarter code (and a nice syntax)
- [JSON based](https://github.com/skrtdev/NovaGram/blob/master/src/json.json), so all methods and types are dinamically created.
- Native Debug, so you will be able to fix bugs immediately.
- Telegram IP check, in order to protect from Fake Update attacks (with Cloudflare too!)
- Optional Telegram Exceptions, for handling Telegram API Errors as you like.
- Global Parse Mode, so you won't need to specify it in each method
- Ability to [retrieve DC](https://docs.novagram.ga/docs.html#getUsernameDC) of Users that has an Username
- Usable with Composer, but also in Hosting Panels that doesn't provide it, with PHPEasyGit

### Index:

   * [Installation](installation.md)
   * [Construct](construct.md)
   * [Requests](requests.md)
   * [Object](objects.md)
   * [All the Methods](docs.md)
