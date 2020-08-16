<?php

namespace Telegram;

class Exception extends \Exception{

    public function __construct(string $method, array $response, array $data, Exception $previous = null) {

        $this->method = $method;
        $this->data = $data;

        parent::__construct($response['description'], $response['error_code'], $previous);
    }

    public function __toString() {
        return __CLASS__ . ":". ( $this->code !== 0 ? " [{$this->code}]:" : "" ) ." {$this->message}\n";
    }

}

?>
