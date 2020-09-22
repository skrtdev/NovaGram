<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;
use skrtdev\Prototypes\Prototype;

class Type {

    use \skrtdev\Prototypes\proto;

    protected Bot $Bot;
    private \stdClass $config;
    private string $_;

    public function __construct(string $type, array $json, Bot $Bot){

        $this->_ = $type;
        $this->Bot = $Bot;

        foreach ($json as $key => $value) $this->$key = $value;

        $this->config = json_decode(json_encode($Bot->getJSON()));

        if($type === "User"){
            if(isset($Bot->database)){
                $Bot->getDatabase()->insertUser($this);
            }
        }

    }
    public function __call(string $name, array $arguments){

        if(!isset($this->config->types_methods->{$this->_})) throw new \skrtdev\NovaGram\Exception("There are no available Methods for a {$this->_} Object (trying to call $name)");
        $this_obj = $this->config->types_methods->{$this->_};

        if(!isset($this_obj->{$name})){
            return Prototype::call(get_class($this), $name, $arguments, $this);
            #throw new \Error("Call to undefined method ".get_class($this)."::$name()");
        }
        $this_method = $this_obj->{$name};

        $data = [];

        foreach ($this_obj->_presets ?? [] as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        foreach ($this_method->presets ?? [] as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        foreach ($this_method->defaults ?? [] as $key => $value) {
            $data[$key] = $value;
        }
        if(is_array($arguments[0])) foreach ($arguments[0] as   $key => $value) {
            $data[$key] = $value;
        }
        elseif(isset($arguments[0])){
            if(isset($this_method->just_one_parameter_needed)) $data[$this_method->just_one_parameter_needed] = $arguments[0];
        }
        if(count($data) === 0) throw new \ArgumentCountError("Too few arguments to function ".get_class($this)."::$name(), 0 passed");

        return $this->Bot->{$this_method->alias ?? $name}($data, $arguments[1] ?? false);
    }

    private function presetToValue(string $preset){
        $obj = $this;
        foreach(explode("/", $preset) as $key) $obj = $obj->$key;
        return $obj;
    }

    public function debug(){
        return $this->Bot->debug($this);
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'config', 'Bot', 'settings', 'payloaded', 'raw_update'] as $key) unset($result[$key]);
        return $result;
    }
}

?>
