<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\{Bot, Exception};
use ArrayAccess, Iterator, Countable;
use skrtdev\Prototypes\Prototypeable;

class ObjectsList implements Iterator, ArrayAccess, Countable {

    use Prototypeable;

    private int $position = 0;
    private array $elements;

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    public function bind(Bot $Bot): void
    {
        foreach ($this->elements as $value) {
            if($value instanceof Type || $value instanceof ObjectsList){
                $value->bind($Bot);
            }
        }
    }

    public function offsetSet($offset, $value): void
    {
        throw new Exception("Could not assign a value to an offset of a List Object");
    }

    public function offsetUnset($offset): void
    {
        throw new Exception("Could not unset an offset of a List Object");
    }

    public function offsetExists($offset): bool
    {
        return isset($this->elements[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->elements[$offset] ?? null;
    }

    public function __get(string $name)
    {
        $name = is_numeric($name) ? (int) $name : $name;
        if(isset($this->elements[$name])){
            return $this->elements[$name];
        }
        else{
            throw new Exception("Trying to access undefined property $name of ObjectsList object");
        }
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->elements[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->elements[$this->position]);
    }

    public function toArray(): array
    {
        $result = $this->elements;
        foreach ($result as &$value) {
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

    public function __debugInfo()
    {
        return $this->elements;
    }

    public function count(): int
    {
        return count($this->elements);
    }
}

