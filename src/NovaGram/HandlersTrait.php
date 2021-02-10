<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\{Message, CallbackQuery};
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
        if(preg_match('/^\/.+\/$/', $pattern) === 0){ // $pattern is not a regex
            $pattern = '/^'.preg_quote($pattern, '/').'$/'; // $pattern becomes a regex
        }
        $this->onTextMessage(function (Message $message) use ($handler, $pattern) {
            if(preg_match_all($pattern, $message->text, $matches) !== 0){
                if(count($matches) > 0){
                    unset($matches[0]);
                }
                $handler($message, array_values($matches));
            }
        });
    }
    
    public function onUserStatus(string $status, Closure $handler): void
    {
        $this->onTextMessage(function (Message $message) use ($handler, $status) {
            if($message->from->status() === $status){
                $handler($message);
            }
        });
    }

    public function onChatStatus(string $status, Closure $handler): void
    {
        $this->onTextMessage(function (Message $message) use ($handler, $status) {
            if($message->chat->status() === $status){
                $handler($message);
            }
        });
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
        $this->onText('/^(?:'.implode('|', $this->settings->command_prefixes).')(?:'.implode('|', $commands).')(?:\@'.$this->getUsername().')?(?: (.+)|$)/', fn($message, $matches) => $handler($message, $matches[0][0] !== "" ? explode(' ', $matches[0][0]) : []));
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
        $this->setMyCommands($commands);
    }

    public function onCallbackData(string $pattern, Closure $handler): void
    {
        if(preg_match('/^\/.+\/$/', $pattern) === 0){ // $pattern is not a regex
            $pattern = '/^'.preg_quote($pattern, '/').'$/'; // $pattern becomes a regex
        }
        $this->onCallbackQuery(function (CallbackQuery $callback_query) use ($handler, $pattern) {
            if(preg_match_all($pattern, $callback_query->data, $matches) !== 0){
                if(count($matches) > 0){
                    unset($matches[0]);
                }
                $handler($callback_query, array_values($matches));
            }
        });
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
