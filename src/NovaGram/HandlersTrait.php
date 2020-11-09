<?php

namespace skrtdev\NovaGram;

use Closure;

trait HandlersTrait{

    public function onUpdate(Closure $handler){
        $this->dispatcher->addClosureHandler($handler);
    }

    public function onMessage(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "message");
    }

    public function onEditedMessage(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "edited_message");
    }

    public function onChannelPost(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "channel_post");
    }

    public function onEditedChannelPost(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "edited_channel_post");
    }

    public function onInlineQuery(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "inline_query");
    }

    public function onChosenInlineResult(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "chosen_inline_result");
    }

    public function onCallbackQuery(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "callback_query");
    }

    public function onShippingQuery(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "shipping_query");
    }

    public function onPreCheckoutQuery(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "pre_checkout_query");
    }

    public function onPoll(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "poll");
    }

    public function onPollAnswer(Closure $handler){
        $this->dispatcher->addClosureHandler($handler, "poll_answer");
    }

}


?>
