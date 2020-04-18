<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

class PublishOption
{
    private string $routing_key;
    private string $payload;
    private string $payload_encoding = 'string';
    private array $properties = [];

    /**
     * @return string
     */
    public function getRoutingKey(): string
    {
        return $this->routing_key;
    }

    /**
     * @param string $routing_key
     */
    public function setRoutingKey(string $routing_key): void
    {
        $this->routing_key = $routing_key;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload(string $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getPayloadEncoding(): string
    {
        return $this->payload_encoding;
    }

    /**
     * @param string $payload_encoding
     */
    public function setPayloadEncoding(string $payload_encoding): void
    {
        $this->payload_encoding = $payload_encoding;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
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
            'properties' => $this->properties
        ];
    }
}