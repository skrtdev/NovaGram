<?php

namespace skrtdev\NovaGram;

use skrtdev\Prototypes\Prototypes;
use skrtdev\Telegram\Exception as TelegramException;
use Throwable;

class TracebackNormalizer
{
    protected static function normalizeTraceArgument($arg, bool $recursive = true): string {
        if (is_object($arg)) {
            return '<'.get_class($arg).' object>';
        }
        elseif (is_array($arg)){
            if(count($arg) <= 5 && is_list($arg) && $recursive){
                return '['.implode(', ', iterate($arg, fn($item) => self::normalizeTraceArgument($item, false))).']';
            }
            else return 'Array';
        }
        elseif (is_string($arg)){
            return strlen($arg) < 30 ? "'$arg'" : "'".substr($arg, 0, 30)."...'";
        }
        elseif (is_bool($arg)){
            return $arg ? 'true' : 'false';
        }
        elseif($arg === null){
            return 'null';
        }
        else return (string) $arg;
    }

    protected static function getTraceAsString(array $trace): string {
        $string = [];
        $i = 0;
        foreach ($trace as $item) {
            $item['args'] ??= [];
            foreach ($item['args'] as $key => &$arg) {
                $arg = (is_string($key) ? "$key: " : '').self::normalizeTraceArgument($arg);
            }
            $called = (isset($item['class']) ? $item['class'].$item['type'] : '').$item['function'];
            $caller = isset($item['file']) ? "{$item['file']}({$item['line']})" : '[internal function]';
            $string []= "#$i $caller: $called(".implode(', ', $item['args']).")";
            $i++;
        }
        $string []= "#$i {main}";
        return implode(PHP_EOL, $string);
    }

    public static function getNormalizedExceptionString(Throwable $e): string
    {
        $backtrace = $e->getTrace();
        $i = 0;
        foreach ($backtrace as &$item) {
            if(($item['function'] ?? null) === '__call' && ($backtrace[$i-1]['class'] ?? null) === Prototypes::class){
                $item['function'] = $item['args'][0];
                $item['args'] = $item['args'][1];
                unset($backtrace[$i-1]);
                unset($backtrace[$i-2]);
                unset($backtrace[$i-3]);
            }
            $i++;
        }
        return explode("\nStack trace:\n", (string) $e)[0]."\nStack trace:\n".self::getTraceAsString($backtrace);
    }
}
