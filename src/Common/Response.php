<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

use JsonException;
use Psr\Http\Message\ResponseInterface;

class Response
{
    public const successCode = [200, 201, 202, 203, 204, 205, 206];
    /**
     * @var bool
     */
    private bool $error;
    /**
     * @var string
     */
    private string $msg;
    /**
     * @var array
     */
    private array $data;

    /**
     * @param ResponseInterface $response
     * @return static
     * @throws JsonException
     */
    public static function make(ResponseInterface $response): self
    {
        $self = new self();
        if (!in_array($response->getStatusCode(), self::successCode)) {
            $self->error = true;
            $self->msg = $response->getReasonPhrase();
        } else {
            $self->error = false;
            $self->msg = 'ok';
            $raw = $response->getBody()->getContents();
            $self->data = !empty($raw) ? json_decode($raw, true, 512, JSON_THROW_ON_ERROR) : [];
        }
        return $self;
    }

    /**
     * @param string $reason
     * @return static
     */
    public static function bad(string $reason): self
    {
        $self = new self();
        $self->error = true;
        $self->msg = $reason;
        $self->data = [];
        return $self;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function result(): array
    {
        return $this->error ? [
            'error' => 1,
            'msg' => $this->msg
        ] : [
            'error' => 0,
            'msg' => $this->msg,
            'data' => $this->data
        ];
    }
}