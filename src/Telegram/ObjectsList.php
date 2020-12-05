<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Exception;
use skrtdev\Prototypes\proto;
use ArrayAccess, Iterator;

class ObjectsList implements Iterator, ArrayAccess {

    use proto;

    private int $position = 0;
    private array $elements;

    public function __construct(array $elements){

        $this->elements = $elements;
    }

    public function offsetSet($offset, $value) {
        throw new Exeption("Could not assign a value to an offset of a List Object");
    }

    public function offsetUnset($offset) {
        throw new Exeption("Could not unset an offset of a List Object");
    }

    public function offsetExists($offset) {
        return isset($this->elements[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->elements[$offset]) ? $this->elements[$offset] : null;
    }

    public function __get(string $name)
    {
        if(isset($this->elements->$name)){
            return $this->elements->$name;
        }
        else{
            throw new Exception("Trying to access undefined property $name of ObjectsList object");
        }
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->elements[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->elements[$this->position]);
    }

}

?>
