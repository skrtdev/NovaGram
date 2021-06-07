<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Exception;
use ArrayAccess, Iterator;
use skrtdev\Prototypes\Prototypeable;

class ObjectsList implements Iterator, ArrayAccess {

    use Prototypeable;

    private int $position = 0;
    private array $elements;

    public function __construct(array $elements) {

        $this->elements = $elements;
    }

    public function offsetSet($offset, $value) {
        throw new Exception("Could not assign a value to an offset of a List Object");
    }

    public function offsetUnset($offset) {
        throw new Exception("Could not unset an offset of a List Object");
    }

    public function offsetExists($offset) {
        return isset($this->elements[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->elements[$offset]) ? $this->elements[$offset] : null;
    }

    public function __get(string $name) {
        $name = is_numeric($name) ? (int) $name : $name;
        if(isset($this->elements[$name])){
            return $this->elements[$name];
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

    public function toArray(): array
    {
        $result = $this->elements;
        foreach ($result as $key => &$value) {
            if($value instanceof Type || $value instanceof ObjectsList){
                $value = $value->toArray();
            }
        }
        return $result;
    }

    public function toJSON(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function getLast()
    {
        return end($this->elements) ?: null;
    }

    public function __debugInfo() {
        return $this->elements;
    }

}

?>
