<?php

namespace skrtdev\NovaGram;

class Utils{

    public static ?bool $is_cli = null;

    public static function IPInRange(string $ip, string $range) {
        if(strpos($range, '/') === false) $range .= '/32';
        [$range, $netmask] = explode( '/', $range, 2 );
        $range_decimal = ip2long($range);
        $ip_decimal = ip2long($ip);
        $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
        $netmask_decimal = ~$wildcard_decimal;
        return ( ($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal) );
    }

    public static function isCloudFlare() {
        $cf_ips = ['173.245.48.0/20','103.21.244.0/22','103.22.200.0/22','103.31.4.0/22','141.101.64.0/18','108.162.192.0/18','190.93.240.0/20','188.114.96.0/20','197.234.240.0/22','198.41.128.0/17','162.158.0.0/15','104.16.0.0/12','172.64.0.0/13','131.0.72.0/22'];
        foreach ($cf_ips as $cf_ip) if (self::IPInRange($_SERVER['REMOTE_ADDR'] ?? null, $cf_ip)) return true;
        return false;
    }

    public static function isTokenValid(string $token){
        return preg_match('/^\d+:[\w\d_-]+$/', $token) === 1;
    }
    public static function getIDByToken(string $token){
        preg_match('/^(\d)+:[\w\d_-]+$/', $token, $matches);
        return (int) $matches[0];
    }

    public static function trigger_error(string $error_msg, int $error_type = E_USER_NOTICE){
        $debug_backtrace = debug_backtrace();
        $caller = end($debug_backtrace);
        trigger_error($error_msg." in {$caller['file']}:{$caller['line']}", $error_type);
    }

    public static function isCLI(){
        self::$is_cli ??= http_response_code() === false;
        return self::$is_cli;
    }

    public static function getFileSHA(){
        $file = file_get_contents(realpath($_SERVER['SCRIPT_FILENAME']));
        return hash("sha256", $file);
    }

    public static function curl(string $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function isTelegram($value='')
    {
        if(!isset($_SERVER['REMOTE_ADDR'])) exit;
        if(isset($_SERVER["HTTP_CF_CONNECTING_IP"]) and self::isCloudFlare()) $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        if(!self::IPInRange($_SERVER['REMOTE_ADDR'], "149.154.160.0/20") and !self::IPInRange($_SERVER['REMOTE_ADDR'], "91.108.4.0/22")) return false;
        return true;
    }
}

?>
