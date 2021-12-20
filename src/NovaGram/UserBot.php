<?php declare(strict_types=1);

namespace skrtdev\NovaGram;

use skrtdev\Telegram\{UnauthorizedException, BadRequestException};

class UserBot extends Bot{

    public function __construct(string $token, array $settings = [], ...$kwargs) {
        $this->settings = self::normalizeSettings(['export_commands' => false, 'disable_ip_check' => true] + $settings + $kwargs + ['bot_api_url' => 'https://botapi.giuseppem99.xyz']);
        $this->initializeLogger();

        if(!Utils::isTokenValid($token)){
            $path = realpath('.');
            $files = glob("$path/$token.token*");
            if(!empty($files)){
                if(count($files) !== 1){
                    throw new Exception("There are more token files for a single account");
                }
                $filename = $files[0];
                $real_token = file_get_contents($filename);
                $this->initializeToken($real_token);
            }
            else{
                if(Utils::isCLI()){
                    echo 'Insert phone number: ';

                    while(true){
                        $phone_number = trim(str_replace(["+", " "], "", fgets(STDIN)));
                        $this->endpoint = trim($this->settings->bot_api_url, '/').'/';
                        try{
                            $result = $this->APICAll("userlogin", ["phone_number" => $phone_number]);
                            $real_token = $result->token;
                            break;
                        }
                        catch(UnauthorizedException $e){
                            echo 'Invalid phone number, retry: ';
                        }
                    }

                    $this->initializeToken($real_token);
                    $this->initializeEndpoint();


                    echo 'Insert code: ';
                    while(true){
                        $code = (int) fgets(STDIN);
                        try{
                            $result = $this->APICAll("authcode", ["code" => $code]);
                            break;
                        }
                        catch(BadRequestException $e){
                            echo 'Invalid code, retry: ';
                        }
                    }

                    if($result->authorization_state === "wait_password"){
                        echo isset($result->password_hint) ? "Insert 2fa password (hint: $result->password_hint): " : 'Insert 2fa password: ';
                        while(true){
                            $password = trim(fgets(STDIN));
                            try{
                                $this->APICAll("2fapassword", ["password" => $password]);
                                break;
                            }
                            catch(BadRequestException $e){
                                echo 'Wrong password, retry: ';
                            }
                        }
                    }

                    file_put_contents("$token.token".random_string(), $real_token);
                    $this->processSettings();
                }
                else{
                    file_put_contents('method.php', file_get_contents(__DIR__.'/WebLogin/method.php'));
                    printf('<script type="text/javascript">'.file_get_contents(__DIR__.'/WebLogin/JSLogin.js').'</script>', $this->settings->bot_api_url, $token);
                    exit();
                }
            }
        }
        else{
            $this->initializeToken($token);
        }

        $this->initializeEndpoint();
        $this->processSettings();
    }

    protected function initializeEndpoint(): void
    {
        $this->endpoint = trim($this->settings->bot_api_url, '/')."/user$this->token/";
    }

    protected function initializeToken(string $token): void
    {
        $this->token = trim($token);
        $this->id = Utils::getIDByToken($token);
    }

    public function getUsername(): string
    {
        return parent::getUsername() ?? '';
    }
}
