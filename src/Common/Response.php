<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

use Exception;
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
     * Response constructor.
     * @param ResponseInterface $response
     * @throws Exception
     */
    public function __construct(ResponseInterface $response)
    {
        if (!in_array($response->getStatusCode(), self::successCode)) {
            $this->error = true;
            $this->msg = $response->getReasonPhrase();
        } else {
            $this->error = false;
            $this->msg = 'ok';
            $raw = $response->getBody()->getContents();
            $this->data = !empty($raw) ? json_decode($raw, true, 512, JSON_THROW_ON_ERROR) : [];
        }
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