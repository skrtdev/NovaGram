<?php declare(strict_types=1);

namespace skrtdev\NovaGram;

use skrtdev\Telegram\{UnauthorizedException, NotFoundException};

class UserBot extends Bot{

    public function __construct(string $token, array $settings = [], ?Logger $logger = null, ...$kwargs) {
        $this->settings = $this->normalizeSettings(["is_user" => true] + $settings + $kwargs + ["bot_api_url" => "https://botapi.giuseppem99.xyz"]);
        $this->initializeLogger($logger);

        if(!Utils::isTokenValid($token)){
            $filename = "$token.token";
            if(file_exists($filename)){
                $token = file_get_contents($filename);
                $this->initializeToken($token);
                $this->initializeEndpoint();
                $this->processSettings();
            }
            else{
                if(!isset($this->settings->bot_api_url)){
                    throw new Exception("Bot Api URL has not been provided");
                }
                print("Insert phone number: ");

                while(true){
                    $phone_number = trim(str_replace(["+", " "], "", fgets(STDIN)));
                    $this->endpoint = trim($this->settings->bot_api_url, '/').'/';
                    try{
                        $token = $this->APICAll("userlogin", ["phone_number" => $phone_number]);
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
                        $this->APICAll("authcode", ["code" => $code]);
                        break;
                    }
                    catch(UnauthorizedException $e){
                        print("Invalid code, retry: ");
                    }
                }

                try {
                    $this->getMe();
                }
                catch(NotFoundException $e){
                    print("Insert 2fa password: ");
                    while(true){
                        $password = trim(fgets(STDIN));
                        try{
                            $this->APICAll("2fapassword", ["password" => $password]);
                            break;
                        }
                        catch(UnauthorizedException $e){
                            print("Wrong password, retry: ");
                        }
                    }
                }

                file_put_contents($filename, $token);
                $this->processSettings();
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
