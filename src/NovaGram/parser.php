<?php

namespace skrtdev\NovaGram;

use \stdClass;

class EntityParser{

    const TAGS = [
        "bold" => "b",
        "italic" => "i",
        "text_link" => "a",
        "text_mention" => "a",
        "underline" => "ins",
        "strikethrough" => "strike",
        "code" => "code",
        "pre" => "pre"
    ];

    const SKIP_ENTITES = [
        "bot_command",
        "mention",
        "url"
    ];


    public static function EntitiesToArray(stdClass $entities){
        $real_entities = [];
        foreach ($entities as $entity) {
            $offset = $entity->offset;
            $length = $entity->length;
            $type = $entity->type;
            $tags = self::TAGS;

            if(in_array($type, self::SKIP_ENTITES)) continue;

            foreach ($tags as $entity_type => $html_tag) {
                if($type === $entity_type) $tag = $html_tag;
            }
            if(!isset($tag)){
                throw new Exception("Could not parse Message Entities: not found entity '$type', please report issue - https://novagram.ga");
            }

            if ($type === "text_link") $openTag = "<$tag href='{$entity->url}'>";
            elseif ($type === "text_mention") $openTag = "<$tag href='tg://user?id={$entity->user->id}'>";
            #elseif ($type === "mention") $openTag = "<$tag href='https://t.me/".str_replace('@', '', )."'>";
            # TODO: find a way do get entities value inside this function
            else $openTag = "<$tag>";
            // will turn into a match in php8

            $closeTag = "</$tag>";
            unset($tag);

            $real_entities[$offset] ??= [];
            $real_entities[$offset][] = $openTag;

            $real_entities[$offset + $length] ??= [];
            $real_entities[$offset + $length][] = $closeTag;
        }
        return $real_entities;
    }

    public static function mbStringToArray($string, $encoding = 'UTF-8'){
        $array = [];
        $strlen = mb_strlen($string, $encoding);
        while ($strlen) {
            $array[] = mb_substr($string, 0, 1, $encoding);
            $string = mb_substr($string, 1, $strlen, $encoding);
            $strlen = mb_strlen($string, $encoding);
        }
        return $array;
    }

    public static function TextEntitiesToHTML(string $text, stdClass $entities){

        $textToParse = mb_convert_encoding($text." ", 'UTF-16BE', 'UTF-8');

        $real_entities = self::EntitiesToArray($entities);
        $res = "";

        foreach (self::mbStringToArray($textToParse, 'UTF-16LE') as $offset => $value) {
            if(isset($real_entities[$offset])){
                if(strpos($real_entities[$offset][0], '/') === false){
                    $real_entities[$offset] = array_reverse($real_entities[$offset]);
                }
                foreach($real_entities[$offset] as $t){
                    $res .= mb_convert_encoding($t, 'UTF-16BE', 'UTF-8');
                }
            }
            $res .= $value;
        }
        $res = mb_convert_encoding($res, 'UTF-8', 'UTF-16BE');
        return trim($res);
    }
}

?>
