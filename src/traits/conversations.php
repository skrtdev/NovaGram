<?php

namespace NovaGram;

trait conversations{
    public function conversation(string $name, $value = null, array $additional_param = []){

        $this->Bot->db->initializeConversations();
        #echo "conversation to {$this->id}; \nname: $name\nvalue: $value\n\n";

        $db = $this->Bot->db;

        if(isset($value)){
            return $db->setConversation($this->id, $name, $value, $additional_param);
        }
        else{
            return $db->getConversation($this->id, $name, $this->Bot->update ?? null);
        }
    }

    public function clearConversation(string $name){

        $this->Bot->db->initializeConversations();
        #echo "conversation to {$this->id}; \nname: $name\nvalue: $value\n\n";

        $db = $this->Bot->db;

        return $db->deleteConversation($this->id, $name);

    }

    // $options is string|array;;;
    public function status(string $value = null, ?array $options = null, bool $permanent = false){
        return $this->conversation("status", $value, $options ?? [] + ["is_permanent" => $permanent]);
    }
    public function clearStatus(){
        return $this->clearConversation("status");
    }
}

?>
