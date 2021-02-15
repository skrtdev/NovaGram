<?php
namespace skrtdev\NovaGram;

trait dc{
    public function getDC() {
        if(!isset($this->username)) throw new Exception("{$this->_} passed to getDC has not an username");
        return $this->dc_id ??= Bot::getUsernameDC($this->username);
    }
}

?>
