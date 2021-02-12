<?php declare(strict_types=1);

namespace skrtdev\NovaGram;

use skrtdev\Telegram\{UnauthorizedException, BadRequestException};

class UserBot extends Bot{

    public function __construct(string $token, array $settings = [], ?Logger $logger = null, ...$kwargs) {
        $this->settings = $this->normalizeSettings(["is_user" => true, "disable_ip_check" => true] + $settings + $kwargs + ["bot_api_url" => "https://botapi.giuseppem99.xyz"]);
        $this->initializeLogger($logger);

        if(!Utils::isTokenValid($token)){
            $filename = realpath("$token.token");
            if(is_string($filename) && file_exists($filename)){
                $token = file_get_contents($filename);
                $this->initializeToken($token);
                $this->initializeEndpoint();
                $this->processSettings();
                if($this->settings->mode !== self::CLI && !Utils::isCLI()){
                    $this->logger->critical('Using token file is dangerous: it is publicly available. Please copy and paste your token from your file directly in your code - and delete the file');
                }
            }
            else{
                if(Utils::isCLI()){
                    print("Insert phone number: ");

                    while(true){
                        $phone_number = trim(str_replace(["+", " "], "", fgets(STDIN)));
                        $this->endpoint = trim($this->settings->bot_api_url, '/').'/';
                        try{
                            $result = $this->APICAll("userlogin", ["phone_number" => $phone_number]);
                            $token = $result->token;
                            break;
                        }
                        catch(UnauthorizedException $e){
                            print("Invalid phone number, retry: ");
                        }
                    }

                    $this->initializeToken($token);
                    $this->initializeEndpoint();


                    print("Insert code: ");
                    while(true){
                        $code = (int) fgets(STDIN);
                        try{
                            $result = $this->APICAll("authcode", ["code" => $code]);
                            break;
                        }
                        catch(BadRequestException $e){
                            print("Invalid code, retry: ");
                        }
                    }

                    if($result->authorization_state === "wait_password"){
                        print("Insert 2fa password (hint: {$result->password_hint}): ");
                        while(true){
                            $password = trim(fgets(STDIN));
                            try{
                                $this->APICAll("2fapassword", ["password" => $password]);
                                break;
                            }
                            catch(BadRequestException $e){
                                print("Wrong password, retry: ");
                            }
                        }
                    }

                    file_put_contents("$token.token", $token);
                    $this->processSettings();
                }
                else{
                    file_put_contents('method.php', file_get_contents(__DIR__.'/WebLogin/method.php'));
                    echo sprintf('<script type="text/javascript">'.file_get_contents(__DIR__.'/WebLogin/JSLogin.js').'</script>', $this->settings->bot_api_url, $token);
                    exit();
                }
            }
        }
        else{
            $this->initializeToken($token);
            $this->initializeEndpoint();
            $this->processSettings();
        }
    }

}

?>
