<?php

namespace skrtdev\NovaGram;

use \stdClass;

class EntityParser{

    public static function EntitiesToArray(stdClass $entities){
        $real_entities = [];
        foreach ($entities as $entity) {
            $offset = $entity->offset;
            $length = $entity->length;
            $tag = $entity->type;
            $tags = [
                "bold" => "b",
                "italic" => "i",
                "text_link" => "a",
                "underline" => "ins"
            ];
            foreach ($tags as $tg_tag => $html_tag) {
                if($tag === $tg_tag) $tag = $html_tag;
            }
            $openTag = $tag === "a" ? "<$tag href='{$entity->url}'>" : "<$tag>";
            $closeTag = "</$tag>";

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
        $res2 = "";

        foreach (self::mbStringToArray($textToParse, 'UTF-16LE') as $offset => $value) {
            if(isset($real_entities[$offset])){
                if(strpos($real_entities[$offset][0], '/') === false){
                    $real_entities[$offset] = array_reverse($real_entities[$offset]);
                }
                foreach($real_entities[$offset] as $t){
                    $res2 .= mb_convert_encoding($t, 'UTF-16BE', 'UTF-8');
                }
            }
            $res2 .= $value;
        }
        $res2 = mb_convert_encoding($res2, 'UTF-8', 'UTF-16BE');

        return trim($res2);

    }
}

?>
