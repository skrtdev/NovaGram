<?php

namespace NovaGram;

trait conversations{
    public function conversation(string $name, $value = null, array $additional_param = []){

        $db = $this->Bot->db or exit;

        if(isset($value)){
            return $db->setConversation($this->id, $name, $value, $additional_param);
        }
        else{
            return $db->getConversation($this->id, $name, $this->Bot->update ?? null);
        }
    }

    public function clearConversation(string $name){

        #echo "conversation to {$this->id}; \nname: $name\nvalue: $value\n\n";

        $db = $this->Bot->db or exit;

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
