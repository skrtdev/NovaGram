<?php

namespace skrtdev\NovaGram;

trait conversations{
    public function conversation(string $name, $value = null, bool $permanent = true){

        $db = $this->Bot->database or exit(trigger_error("404 DB NOT FOUND"));

        if(isset($value)){
            return $db->setConversation($this->id, $name, $value, ["is_permanent" => $permanent]);
        }
        else{
            return $db->getConversation($this->id, $name);
        }
    }

    public function clearConversation(string $name){

        #echo "conversation to {$this->id}; \nname: $name\nvalue: $value\n\n";

        $db = $this->Bot->database or exit(trigger_error("404 DB NOT FOUND"));

        return $db->deleteConversation($this->id, $name);

    }

    // $options is string|array;;;
    public function status(string $value = null, $options = null, bool $permanent = false){
        if(is_bool($options)){
            $permanent = $options;
        }
        elseif(isset($options)){
            Utils::trigger_error("Using v1.2 for conversations, check updated docs at https://docs.novagram.ga/database.html", E_USER_DEPRECATED);
        }
        return $this->conversation("status", $value, $permanent);
    }
    public function clearStatus(){
        return $this->clearConversation("status");
    }
}

?>
