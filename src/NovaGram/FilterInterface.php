<?php


namespace skrtdev\NovaGram;

use skrtdev\Telegram\Message;

interface FilterInterface{
    /**
     * At least Message must be implemented. If you don't want to implement Message, leave it in the signature and remove it from isAllowedUpdate
     * @param Message $object
     * @return bool
     */
    public function handle(Message $object): bool;
    public function isAllowedUpdate(string $update_type): bool;
}