<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;
use skrtdev\Prototypes\Prototypeable;
use stdClass;

class Type {

    use Prototypeable;

    protected ?Bot $Bot;

    public function __construct(array $array, Bot $Bot = null){
        $this->Bot = $Bot;

        foreach ($array as $key => $value) $this->$key ??= is_array($value) ? (object) $value : $value;
    }

    public function bind(Bot $Bot): void
    {
        $this->Bot = $Bot;
        foreach ($this as $value) {
            if($value instanceof Type || $value instanceof ObjectsList){
                $value->bind($Bot);
            }
        }
    }

    public function debug(){
        return $this->Bot->debug($this);
    }

    public function toArray(): array
    {
        $result = get_object_vars($this);
        foreach(['config', 'Bot'] as $key){
            unset($result[$key]);
        }
        foreach ($result as $key => &$value) {
            if(!isset($value)){
                unset($result[$key]);
            }
            elseif($value instanceof Type || $value instanceof ObjectsList){
                $value = $value->toArray();
            }
        }
        return $result;
    }

    public function toJSON(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        unset($result['Bot']);
        foreach ($result as $key => $value) {
            if(!isset($value) || $value instanceof stdClass){
                unset($result[$key]);
            }
        }
        return $result;
    }

    public function __serialize()
    {
        $obj = get_object_vars($this);
        unset($obj['config']);
        return $obj;
    }
}
