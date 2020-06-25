<?php

class NovaGramException extends Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ":". ( $this->code !== 0 ? " [{$this->code}]:" : "" ) ." {$this->message}\n";
    }

}

class TelegramException extends Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ":". ( $this->code !== 0 ? " [{$this->code}]:" : "" ) ." {$this->message}\n";
    }

}

?>
