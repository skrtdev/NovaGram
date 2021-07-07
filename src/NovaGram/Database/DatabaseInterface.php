<?php

namespace skrtdev\NovaGram\Database;

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\User;

interface DatabaseInterface
{
    public function setConversation(int $chat_id, string $name, $value, array $params = []): void;

    public function getConversation(int $chat_id, string $name);

    public function deleteConversation(int $chat_id, string $name): void;

    public function deleteChatConversations(int $chat_id): void;

    public function reset(): void;

    public function insertUser(User $user): void;

    public function bind(Bot $Bot): void;
}