<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

class PublishOption
{
    /**
     * @var string
     */
    private string $routing_key;
    /**
     * @var string
     */
    private string $payload;
    /**
     * @var string
     */
    private string $payload_encoding = 'string';
    /**
     * @var array
     */
    private array $properties = [];

    /**
     * @param string $routing_key
     */
    public function setRoutingKey(string $routing_key): void
    {
        $this->routing_key = $routing_key;
    }

    /**
     * @param string $payload
     */
    public function setPayload(string $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * should be either "string" or "base64"
     * @param string $payload_encoding
     */
    public function setPayloadEncoding(string $payload_encoding): void
    {
        $this->payload_encoding = $payload_encoding;
    }

    /**
     * @param array $properties
     */
    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return [
            'routing_key' => $this->routing_key,
            'payload' => $this->payload,
            'payload_encoding' => $this->payload_encoding,
            'properties' => (object)$this->properties
        ];
    }
}