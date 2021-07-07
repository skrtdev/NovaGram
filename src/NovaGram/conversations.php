<?php

namespace skrtdev\NovaGram;

trait conversations{
    public function conversation(string $name, $value = null, bool $permanent = true){
        $db = $this->Bot->getDatabase();

        if(isset($value)){
            return $db->setConversation($this->id, $name, $value, ["is_permanent" => $permanent]);
        }
        else{
            return $db->getConversation($this->id, $name);
        }
    }

    public function clearConversation(string $name){
        $db = $this->Bot->getDatabase();
        return $db->deleteConversation($this->id, $name);
    }

    public function status(string $value = null, bool $permanent = false)
    {
        return $this->conversation("status", $value, $permanent);
    }

    public function clearStatus(): void
    {
        $this->clearConversation("status");
    }

    public function getConversations(): array
    {
        return $this->Bot->getDatabase()->getChatConversations($this->id);
    }

    public function deleteAllConversations(): void
    {
        $this->Bot->getDatabase()->deleteChatConversations($this->id);
    }

}
