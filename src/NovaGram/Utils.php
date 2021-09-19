<?php

namespace skrtdev\NovaGram;

use Generator;
use skrtdev\NovaGram\Database\{DatabaseInterface, MySQLDatabase, SQLiteDatabase};
use ReflectionFunction;

class Utils{

    const EXCLUDE_FILES = ['..', '.', 'vendor'];

    public static array $curl_options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => Bot::TIMEOUT
    ];

    public static ?bool $is_cli = null;
    protected static array $included_files;

    public static function IPInRange(string $ip, string $range): bool
    {
        if(strpos($range, '/') === false) $range .= '/32';
        [$range, $netmask] = explode( '/', $range, 2 );
        $range_decimal = ip2long($range);
        $ip_decimal = ip2long($ip);
        $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
        $netmask_decimal = ~$wildcard_decimal;
        return ( ($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal) );
    }

    public static function isCloudFlare(): bool
    {
        $cf_ips = ['173.245.48.0/20','103.21.244.0/22','103.22.200.0/22','103.31.4.0/22','141.101.64.0/18','108.162.192.0/18','190.93.240.0/20','188.114.96.0/20','197.234.240.0/22','198.41.128.0/17','162.158.0.0/15','104.16.0.0/12','172.64.0.0/13','131.0.72.0/22'];
        foreach ($cf_ips as $cf_ip) if (self::IPInRange($_SERVER['REMOTE_ADDR'] ?? null, $cf_ip)) return true;
        return false;
    }

    public static function isTokenValid(string $token): bool
    {
        return preg_match('/^\d{5,12}:[\w\d_-]{30,50}$/', $token) === 1;
    }
    public static function getIDByToken(string $token): int
    {
        preg_match('/^(\d{5,20}):[\w\d_-]{30,50}$/', $token, $matches);
        return (int) $matches[0];
    }

    public static function trigger_error(string $error_msg, int $error_type = E_USER_NOTICE): void
    {
        $debug_backtrace = debug_backtrace(~DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS);
        foreach ($debug_backtrace as $caller) {
            if(!str_contains($caller['file'], 'vendor/skrtdev')){
                break;
            }
        }
        trigger_error("$error_msg in {$caller['file']} on line {$caller['line']}".PHP_EOL.'thrown', $error_type); // PHP_EOL so PHPStorm shows path as clickable
    }

    public static function var_dump($mixed): string
    {
        ob_start();
        var_dump($mixed);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public static function htmlspecialchars(string $string): string
    {
        return str_replace(['<', '>', '&'], ['&lt;', '&gt;', '&amp;'], $string);
    }

    public static function isCLI(): bool
    {
        return self::$is_cli ??= http_response_code() === false;
    }

    public static function getFilesHash(): string
    {
        self::$included_files ??= get_included_files();
        $hash = '';
        foreach (self::$included_files as $path) {
            $hash .= hash('sha256', @file_get_contents($path));
        }
        return hash('sha256', $hash);
    }

    public static function curl(string $url, array $data = []): string
    {
        $options = self::$curl_options + [CURLOPT_URL => $url];

        if(!empty($data)){
            $options += [
                CURLOPT_POSTFIELDS => $data
            ];
        }

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if(!empty(curl_error($ch))){
            throw new CurlException(curl_error($ch));
        }
        curl_close($ch);
        return $response;
    }

    public static function isTelegram(): bool
    {
        if(!isset($_SERVER['REMOTE_ADDR'])) exit;
        if(isset($_SERVER["HTTP_CF_CONNECTING_IP"]) && self::isCloudFlare()) $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        if(!self::IPInRange($_SERVER['REMOTE_ADDR'], "149.154.160.0/20") && !self::IPInRange($_SERVER['REMOTE_ADDR'], "91.108.4.0/22")) return false;
        return true;
    }

    public static function getClassHandlersPaths(string $directory = '.'): Generator
    {
        $directory = realpath($directory).'/';
        foreach (array_diff(scandir($directory), self::EXCLUDE_FILES) as $filename) {
            $filename = $directory.$filename;
            if(!is_dir($filename)){
                if(preg_match('/.+\/([\w\d]+Handler)\.php/', $filename, $matches) === 1){
                    yield $matches[1] => $filename;
                }
            }
            else{
                yield from self::getClassHandlersPaths($filename);
            }
        }
    }

    public static function getCommandHandlersPaths(string $directory = '.'): Generator
    {
        $directory = realpath($directory).'/';
        foreach (array_diff(scandir($directory), self::EXCLUDE_FILES) as $filename) {
            $filename = $directory.$filename;
            if(!is_dir($filename)){
                if(preg_match('/.+\/([\w\d]+Command)\.php/', $filename, $matches) === 1){
                    yield $matches[1] => $filename;
                }
            }
            else{
                yield from self::getCommandHandlersPaths($filename.'/');
            }
        }
    }

    public static function getCallbackHandlersPaths(string $directory = '.'): Generator
    {
        $directory = realpath($directory).'/';
        foreach (array_diff(scandir($directory), self::EXCLUDE_FILES) as $filename) {
            $filename = $directory.$filename;
            if(!is_dir($filename)){
                if(preg_match('/.+\/([\w\d]+Callback)\.php/', $filename, $matches) === 1){
                    yield $matches[1] => $filename;
                }
            }
            else{
                yield from self::getCallbackHandlersPaths($filename);
            }
        }
    }

    public static function isStringRegex(string $string): bool
    {
        return str_starts_with($string, '/') && str_ends_with($string, '/');
    }

    public static function isPHP8(): bool
    {
        return PHP_MAJOR_VERSION >= 8;
    }

    /**
     * @throws Exception
     */
    public static function ArrayToDatabaseInterface(array $array): DatabaseInterface
    {
        $driver = $array['driver'] ?? 'mysql';
        $array['host'] ??= 'localhost:3306';
        $array['prefix'] ??= 'novagram';
        if($driver === 'sqlite' || $driver === 'sqlite3'){
            return new SQLiteDatabase($array['host'], $array['prefix']);
        }
        elseif($driver === 'mysql'){
            return new MySQLDatabase($array['host'], $array['dbname'], $array['dbuser'], $array['dbpass'], $array['prefix']);
        }
        else throw new Exception("Unknown driver $driver, create your own class or file an issue on GitHub <https://github.com/skrtdev/NovaGram>");
    }

    /**
     * @param callable $callable
     * @return FilterInterface[]
     */
    public static function getFilters(callable $callable): array
    {
        if(!self::isPHP8()) return [];
        /** @var FilterInterface[] $result */
        $result = [];
        $reflection = new ReflectionFunction($callable);
        foreach ($reflection->getAttributes() as $attribute) {
            if(is_a($attribute->getName(), FilterInterface::class, true)){
                $result []= $attribute->newInstance();
            }
        }
        return $result;
    }

}
