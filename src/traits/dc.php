<?php
namespace NovaGram;

trait dc{
    public function getDC() {
        if(!isset($this->username)) throw new Exception("{$this->_} passed to getDC has not an username");
        return Bot::getUsernameDC($this->username);
    }
}

?>
