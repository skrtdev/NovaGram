<?php

namespace skrtdev\NovaGram;

trait conversations{
    public function conversation(string $name, $value = null, bool $permanent = false){

        $db = $this->Bot->db or exit(trigger_error("404 DB NOT FOUND"));

        if(isset($value)){
            return $db->setConversation($this->id, $name, $value, ["is_permanent" => $permanent]);
        }
        else{
            return $db->getConversation($this->id, $name, $this->Bot->update ?? null);
        }
    }

    public function clearConversation(string $name){

        #echo "conversation to {$this->id}; \nname: $name\nvalue: $value\n\n";

        $db = $this->Bot->db or exit(trigger_error("404 DB NOT FOUND"));

        return $db->deleteConversation($this->id, $name);

    }

    // $options is string|array;;;
    public function status(string $value = null, ?array $options = null, bool $permanent = false){
        return $this->conversation("status", $value, $permanent);
    }
    public function clearStatus(){
        return $this->clearConversation("status");
    }
}

?>
