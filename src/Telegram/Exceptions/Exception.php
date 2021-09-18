<?php

namespace skrtdev\Telegram;

use Throwable;

class Exception extends \Exception {

    public ?ResponseParameters $response_parameters = null; // read-only
    public string $method;
    public array $data;

    public function __construct(string $method, array $response, array $data, Throwable $previous = null) {

        $this->method = $method;
        $this->data = $data;
        if (isset($response['parameters'])) {
            $this->response_parameters = new ResponseParameters($response['parameters']);
        }

        parent::__construct($response['description'], $response['error_code'], $previous);
    }

    public function __toString() {
        return get_class($this) . ": {$this->getCode()} {$this->getMessage()} (caused by {$this->method}) in {$this->getFile()}:{$this->getLine()}\nStack trace:\n".$this->getTraceAsString();
    }

    public static function create(string $method, array $response, array $data, Throwable $previous = null): self
    {
        $args = [$method, $response, $data, $previous];
        switch ($response['error_code']) {
            case 400:
                return new BadRequestException(...$args);
            case 401:
                return new UnauthorizedException(...$args);
            case 403:
                return new ForbiddenException(...$args);
            case 404:
                return new NotFoundException(...$args);
            case 405:
                return new MethodNotAllowedException(...$args);
            case 409:
                return new ConflictException(...$args);
            case 413:
                return new RequestEntityTooLargeException(...$args);
            case 429:
                return new TooManyRequestsException(...$args);
            case 501:
                return new InternalServerErrorException(...$args);
            case 502:
                return new BadGatewayException(...$args);
            default:
                return new self(...$args);
        }
    }
}
