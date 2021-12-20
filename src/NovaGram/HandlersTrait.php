<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\{ChatMemberUpdated, Message, CallbackQuery, BadRequestException};
use Closure;
#use JetBrains\PhpStorm\ExpectedValues;

trait HandlersTrait{

    protected array $commands = [];
    protected array $scoped_commands = [];

    // closure handlers

    public function onUpdate(Closure $handler): void
    {
        $this->getDispatcher()->addClosureHandler($handler);
    }

    public function onMessage(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'message', $filters, $filter, $group);
    }

    public function onEditedMessage(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'edited_message', $filters, $filter, $group);
    }

    public function onChannelPost(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'channel_post', $filters, $filter, $group);
    }

    public function onEditedChannelPost(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'edited_channel_post', $filters, $filter, $group);
    }

    public function onInlineQuery(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'inline_query', $filters, $filter, $group);
    }

    public function onChosenInlineResult(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'chosen_inline_result', $filters, $filter, $group);
    }

    public function onCallbackQuery(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'callback_query', $filters, $filter, $group);
    }

    public function onShippingQuery(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'shipping_query', $filters, $filter, $group);
    }

    public function onPreCheckoutQuery(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'pre_checkout_query', $filters, $filter, $group);
    }

    public function onPoll(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'poll', $filters, $filter, $group);
    }

    public function onPollAnswer(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'poll_answer', $filters, $filter, $group);
    }

    public function onMyChatMember(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'my_chat_member', $filters, $filter, $group);
    }

    public function onChatMember(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'chat_member', $filters, $filter, $group);
    }

    public function onChatJoinRequest(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->getDispatcher()->addClosureHandler($handler, 'chat_join_request', $filters, $filter, $group);
    }

    // utilities

    public function onTextMessage(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->onMessage($handler, $filters, [fn($message) => isset($message->text), $filter], $group);
    }

    public function onText(string $pattern, Closure $handler, array $filters = null, $filter = null, int $group = 0): void
    {
        if(!Utils::isStringRegex($pattern)){ // $pattern is not a regex
            $this->onTextMessage($handler, $filters, [fn($message) => $message->text === $pattern, $filter], $group);
        }
        else{
            $this->onTextMessage(function (Message $message) use ($handler, $pattern) {
                if(preg_match($pattern, $message->text, $matches)){
                    if(count($matches) > 0){
                        unset($matches[0]);
                    }
                    $handler($message, array_values($matches));
                }
            }, $filters ?? Utils::getFilters($handler), [fn($message) => preg_match($pattern, $message->text), $filter], $group);
        }
    }

    /**
     * @param string|string[] $commands
     * @param Closure $handler
     * @param CommandScope|CommandScope[]|null $command_scopes
     * @param string|null $description
     * @param FilterInterface[]|null $filters
     * @param callable|callable[]|null $filter
     * @param int $group
     */
    public function onCommand($commands, Closure $handler, $command_scopes = null, string $description = null, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $filters ??= Utils::getFilters($handler);
        if(is_string($commands)){
            $commands = [$commands];
        }
        foreach($commands as $command){
            if($command_scopes === null){
                $this->commands[$command] ??= $description ?? "$command command";
            }
            else{
                $filter ??= [];
                if(!is_array($command_scopes)){
                    $command_scopes = [$command_scopes];
                }
                $filter[] = Handler::orFilter(iterate($command_scopes, fn(CommandScope $scope) => $scope->getFilter()));
                foreach ($command_scopes as $command_scope) {
                    foreach ($command_scope->getScopes() as $scope) {
                        $scope = json_encode(array_filter($scope));
                        $this->scoped_commands[$scope] ??= [];
                        $this->scoped_commands[$scope] [] = ['command' => $command, 'description' => $description ?? "$command command"];
                    }
                }
            }
        }
        $this->onText(
            '/^(?:'.implode('|', $this->settings->command_prefixes).')(?:'.implode('|', $commands).')(?:\@'. ($this->settings->mode === self::WEBHOOK && !isset($this->settings->username) ? '.+' : $this->getUsername()) .')?(?: .*|$)/',
            fn(Message $message) => $handler($message, array_slice(explode(' ', $message->text), 1)),
            $filters,
            [fn(Message $message) => $message->forward_date === null, $filter],
            $group
        );
    }

    public function exportCommands(): void
    {
        $commands = [];
        foreach($this->commands as $command => $description){
            $commands[] = [
                'command' => $command,
                'description' => $description
            ];
        }
        foreach($this->scoped_commands as $scope => $scope_commands){
            $scope = json_decode($scope, true);
            try{
                $this_scope_commands = [...$scope_commands, ...$commands];
                $chat_id = $scope['scope']['chat_id'] ?? null;
                if(isset($chat_id)){
                    $this_scope_commands = [...$this_scope_commands, ...$this->scoped_commands[json_encode([
                        'scope' => [
                            'type' => $chat_id > 0 ? 'all_private_chats' : 'all_group_chats',
                            'chat_id' => null
                        ]
                    ])] ?? []];
                }
                $this->setMyCommands($this_scope_commands, $scope);
            }
            catch(BadRequestException $e){
                $this->logger->error("Couldn't export scope-specific commands: {$e->getMessage()}");
            }
        }
        try{
            $this->setMyCommands($commands);
        }
        catch(BadRequestException $e){
            $this->logger->error("Couldn't export commands: {$e->getMessage()}");
        }
    }

    public function onCallbackData(string $pattern, Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        if(!Utils::isStringRegex($pattern)){ // $pattern is not a regex
            $this->onCallbackQuery($handler, $filters, [fn($callback_query) => $callback_query->data === $pattern, $filter], $group);
        }
        else{
            $this->onCallbackQuery(function (CallbackQuery $callback_query) use ($handler, $pattern) {
                if(preg_match($pattern, $callback_query->data, $matches) !== 0){
                    if(count($matches) > 0){
                        unset($matches[0]);
                    }
                    $handler($callback_query, array_values($matches));
                }
            }, Utils::getFilters($handler), [fn($callback_query) => preg_match($pattern, $callback_query->data), $filter], $group);
        }
    }

    public function onNewChatMember(
        Closure $handler,
        //#[ExpectedValues([Bot::USERS_ONLY, Bot::BOTS_ONLY, Bot::ALL])]
        #int $type = Bot::USERS_ONLY,
        ?array $filters = null,
        $filter = null,
        int $group = 0
    ): void
    {
        $this->onChatMember(

            function (ChatMemberUpdated $chatMemberUpdated) use ($handler) {
                $new_chat_member = $chatMemberUpdated->new_chat_member;
                $handler($chatMemberUpdated->chat, $new_chat_member->user, $chatMemberUpdated->from);
            },
            $filters ?? Utils::getFilters($handler),
            [
                function(ChatMemberUpdated $chatMemberUpdated) /*use ($type)*/ {
                    $old_chat_member = $chatMemberUpdated->old_chat_member;
                    $new_chat_member = $chatMemberUpdated->new_chat_member;
                    #$user = $new_chat_member->user;
                    return in_array($chatMemberUpdated->chat->type, ['group', 'supergroup']) && (
                            (in_array($old_chat_member->status, ['left', 'kicked']) && in_array($new_chat_member->status, ['member', 'administrator', 'creator'])) || ($old_chat_member->is_member === false && $new_chat_member->is_member === true)
                    )/* && ($type === Bot::ALL || $user->is_bot === (bool) $type)*/;
                },
                $filter
            ],
            $group
        );
    }

    public function onNewGroup(Closure $handler, ?array $filters = null, $filter = null, int $group = 0): void
    {
        $this->onMyChatMember(
            function (ChatMemberUpdated $chatMemberUpdated) use ($handler) {
                $handler($chatMemberUpdated->chat, $chatMemberUpdated->from);
            },
            $filters ?? Utils::getFilters($handler),
            [
                function(ChatMemberUpdated $chatMemberUpdated){
                    $old_chat_member = $chatMemberUpdated->old_chat_member;
                    $new_chat_member = $chatMemberUpdated->new_chat_member;
                    return in_array($chatMemberUpdated->chat->type, ['group', 'supergroup']) && ((in_array($old_chat_member->status, ['left', 'kicked']) && in_array($new_chat_member->status, ['member', 'administrator'])) || ($old_chat_member->is_member === false && $new_chat_member->is_member === true));
                },
                $filter
            ],
            $group
        );
    }

    // error handlers

    public function addErrorHandler(Closure $handler){
        $this->getDispatcher()->addErrorHandler($handler);
    }

    // class handlers

    public function addClassHandler($class){
        $this->getDispatcher()->addClassHandler($class);
    }

    public function addCommandHandler($class){
        if(is_string($class)){
            $class = [$class];
        }
        foreach ($class as $handler) {
            if(is_a($handler, BaseCommandHandler::class, true)){
                new $handler($this);
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
                new $handler($this);
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

