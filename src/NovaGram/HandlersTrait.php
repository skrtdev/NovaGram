<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\{Message, CallbackQuery, Chat, User, BadRequestException};
use Closure;

trait HandlersTrait{

    protected array $commands = [];

    // closure handlers

    public function onUpdate(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler);
    }

    public function onMessage(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "message");
    }

    public function onEditedMessage(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "edited_message");
    }

    public function onChannelPost(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "channel_post");
    }

    public function onEditedChannelPost(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "edited_channel_post");
    }

    public function onInlineQuery(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "inline_query");
    }

    public function onChosenInlineResult(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "chosen_inline_result");
    }

    public function onCallbackQuery(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "callback_query");
    }

    public function onShippingQuery(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "shipping_query");
    }

    public function onPreCheckoutQuery(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "pre_checkout_query");
    }

    public function onPoll(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "poll");
    }

    public function onPollAnswer(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "poll_answer");
    }

    public function onMyChatMember(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "my_chat_member");
    }

    public function onChatMember(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler, "chat_member");
    }

    // utilities

    public function onTextMessage(Closure $handler): void
    {
        $this->onMessage(function (Message $message) use ($handler) {
            if(isset($message->text)){
                $handler($message);
            }
        });
    }

    public function onText(string $pattern, Closure $handler): void
    {
        if(!Utils::isStringRegex($pattern)){ // $pattern is not a regex
            $this->onTextMessage(function (Message $message) use ($handler, $pattern) {
                if($message->text === $pattern){
                    $handler($message);
                }
            });
        }
        else{
            $this->onTextMessage(function (Message $message) use ($handler, $pattern) {
                $func = $this->settings->use_preg_match_instead_of_preg_match_all ? 'preg_match' : 'preg_match_all';
                if($func($pattern, $message->text, $matches) !== 0){
                    if(count($matches) > 0){
                        unset($matches[0]);
                    }
                    $handler($message, array_values($matches));
                }
            });
        }
    }

    public function onCommand($commands, Closure $handler, string $description = null): void
    {
        if(is_string($commands)){
            $commands = [$commands];
        }
        $description ??= $commands[0]." command";
        foreach($commands as $command){
            $this->commands[$command] ??= $description;
        }
        $this->onText('/^(?:'.implode('|', $this->settings->command_prefixes).')(?:'.implode('|', $commands).')(?:\@'. ($this->settings->mode === self::WEBHOOK && !isset($this->settings->username) ? '.+' : $this->getUsername()) .')? /', fn(Message $message) => $handler($message, array_slice(explode(' ', $message->text), 1)));
    }

    public function exportCommands(): void
    {
        $commands = [];
        foreach($this->commands as $command => $description){
            $commands[] = [
                "command" => $command,
                "description" => $description
            ];
        }
        try{
            $this->setMyCommands($commands);
        }
        catch(BadRequestException $e){
            $this->logger->error("Couldn't export commands: {$e->getMessage()}");
        }
    }

    public function onCallbackData(string $pattern, Closure $handler): void
    {
        if(!Utils::isStringRegex($pattern)){ // $pattern is not a regex
            $this->onCallbackQuery(function (CallbackQuery $callback_query) use ($handler, $pattern) {
                if($callback_query->data === $pattern){
                    $handler($callback_query);
                }
            });
        }
        else{
            $this->onCallbackQuery(function (CallbackQuery $callback_query) use ($handler, $pattern) {
                $func = $this->settings->use_preg_match_instead_of_preg_match_all ? 'preg_match' : 'preg_match_all';
                if($func($pattern, $callback_query->data, $matches) !== 0){
                    if(count($matches) > 0){
                        unset($matches[0]);
                    }
                    $handler($callback_query, array_values($matches));
                }
            });
        }
    }

    public function onNewChatMember(Closure $closure, bool $get_bots = false): void
    {
        $this->onMessage(function (Message $message) use ($closure, $get_bots) {
            if(isset($message->new_chat_members)){
                $chat = $message->chat;
                $adder = $message->from;
                foreach ($message->new_chat_members as $user) {
                    if($user->is_bot && !$get_bots) continue;
                    $closure($chat, $user, $adder);
                }
            }
        });
    }

    public function onNewGroup(Closure $closure): void
    {
        $this->onNewChatMember(fn (Chat $chat, User $user, User $adder) => $user->id !== $this->id ?: $closure($chat, $adder), true);
    }

    // error handlers

    public function setErrorHandler(...$args){
        Utils::trigger_error("Using deprecated setErrorHandler, use addErrorHandler instead", E_USER_DEPRECATED);
        $this->addErrorHandler(...$args);
    }

    public function addErrorHandler(Closure $handler){
        $this->getDispatcher()->addErrorHandler($handler);
    }

    // class handlers

    public function handleClass($class){
        Utils::trigger_error("Using deprecated handleClass, use addClassHandler instead", E_USER_DEPRECATED);
        $this->getDispatcher()->addClassHandler($class);
    }

    public function addClassHandler($class){
        $this->getDispatcher()->addClassHandler($class);
    }

    public function addCommandHandler($class){
        if(is_string($class)){
            $class = [$class];
        }
        foreach ($class as $handler) {
            if(is_a($handler, BaseCommandHandler::class, true)){
                $_ = new $handler($this);
            }
            else{
                throw new Exception("Invalid command handler provided: $handler");
            }
        }
    }

    public function addCallbackHandler($class){
        if(is_string($class)){
            $class = [$class];
        }
        foreach ($class as $handler) {
            if(is_a($handler, BaseCallbackHandler::class, true)){
                $_ = new $handler($this);
            }
            else{
                throw new Exception("Invalid callback handler provided: $handler");
            }
        }
    }

    // autoloader

    protected function autoloadHandlers(): void
    {
        $classes = [];
        foreach (Utils::getClassHandlersPaths() as $class => $path) {
            require_once $path;
            $classes[] = $class;
        }
        $this->addClassHandler($classes);
        $commands = [];
        foreach (Utils::getCommandHandlersPaths() as $class => $path) {
            require_once $path;
            $commands[] = $class;
        }
        $this->addCommandHandler($commands);
        $callbacks = [];
        foreach (Utils::getCallbackHandlersPaths() as $class => $path) {
            require_once $path;
            $callbacks[] = $class;
        }
        $this->addCallbackHandler($callbacks);
        if($this->settings->mode === self::CLI && (!empty($classes) || !empty($commands) || !empty($callbacks))){
            $this->logger->info('Loaded '.count($classes).' class handlers, '.count($commands).' commands handlers and '.count($callbacks).' callback handlers.');
        }
    }
}


?>
