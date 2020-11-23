<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Message;
use Closure;

trait HandlersTrait{

    public function onUpdate(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler);
    }

    public function onMessage(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "message");
    }

    public function onEditedMessage(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "edited_message");
    }

    public function onChannelPost(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "channel_post");
    }

    public function onEditedChannelPost(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "edited_channel_post");
    }

    public function onInlineQuery(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "inline_query");
    }

    public function onChosenInlineResult(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "chosen_inline_result");
    }

    public function onCallbackQuery(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "callback_query");
    }

    public function onShippingQuery(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "shipping_query");
    }

    public function onPreCheckoutQuery(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "pre_checkout_query");
    }

    public function onPoll(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "poll");
    }

    public function onPollAnswer(Closure $handler): void
    {
        $this->dispatcher->addClosureHandler($handler, "poll_answer");
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
                var_dump($matches);
                if(count($matches) === 1){
                    $handler($message);
                }
                else{
                    unset($matches[0]);
                    $handler($message, array_values($matches));
                }
            }
        });
    }

    public function onCommand($commands, Closure $handler): void{
        if(is_string($commands)){
            $commands = [$commands];
        }
        $this->onText('/^(?:'.implode('|', $this->settings->command_prefixes).')(?:'.implode('|', $commands).')/', $handler);
    }
}


?>
