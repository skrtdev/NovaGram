<?php
namespace skrtdev\NovaGram;

trait dc{
    public function getDC(): ?int
    {
        if(isset($this->dc_id)) return $this->dc_id;

        if(class_exists('\danog\Decoder\FileId')){
            return $this->dc_id = $this->Bot->getUserDC($this->id);
        }
        if(!isset($this->username)) {
            throw new Exception('User or Chat object has not an username. Install tg-file-decoder with `composer require danog/tg-file-decoder` in order to get dc without usernames');
        }
        return $this->dc_id = Bot::getUsernameDC($this->username);
    }
}

