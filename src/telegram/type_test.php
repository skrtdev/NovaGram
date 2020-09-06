<?php

namespace Telegram;

use NovaGram\Bot;

class Type {
    protected Bot $Bot;
    private \stdClass $config;
    private string $_;

    public function __construct(string $type, array $json, Bot $Bot){

        //var_dump($Bot);

        $this->_ = $type;
        $this->Bot = $Bot;

        foreach ($json as $key => $value) $this->$key = $value;

        $this->config = (object) $Bot->getJSON();

        if($type === "User") $Bot->db->insertUser($this);

    }
    public function __call(string $name, array $arguments){

        if(!property_exists($this->config->types_methods, $this->_)) throw new \NovaGram\Exception("There are no available Methods for a {$this->_} Object (trying to call $name)");
        $this_obj = $this->config->types_methods->{$this->_};

        if(!isset($this_obj->{$name})) throw new \Error("Call to undefined method ".get_class($this)."::$name()");
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

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'config', 'Bot', 'settings', 'payloaded', 'raw_update'] as $key) unset($result[$key]);
        return $result;
    }
}

?>
