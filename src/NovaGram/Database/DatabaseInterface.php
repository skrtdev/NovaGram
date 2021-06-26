<?php

namespace skrtdev\NovaGram\Database;

use skrtdev\Telegram\User;

interface DatabaseInterface
{

    public function setConversation(int $chat_id, string $name, $value, array $additional_param = []);

    public function getConversation(int $chat_id, string $name);

    public function deleteConversation(int $chat_id, string $name);

    function normalizeConversation(array $conversation);

    public function insertUser(User $user);
}