<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

class QueueOption
{
    private bool $auto_delete = false;
    private bool $durable = true;
    private array $arguments = [];

    /**
     * @return bool
     */
    public function isAutoDelete(): bool
    {
        return $this->auto_delete;
    }

    /**
     * @param bool $auto_delete
     */
    public function setAutoDelete(bool $auto_delete): void
    {
        $this->auto_delete = $auto_delete;
    }

    /**
     * @return bool
     */
    public function isDurable(): bool
    {
        return $this->durable;
    }

    /**
     * @param bool $durable
     */
    public function setDurable(bool $durable): void
    {
        $this->durable = $durable;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function setMessageTtl(int $value): void
    {
        $this->arguments['x-message-ttl'] = $value;
    }

    public function setExpires(int $value): void
    {
        $this->arguments['x-expires'] = $value;
    }

    public function setMaxLength(int $value): void
    {
        $this->arguments['x-max-length'] = $value;
    }

    public function setMaxLengthBytes(int $value): void
    {
        $this->arguments['x-max-length-bytes'] = $value;
    }

    public function setOverflow(string $value): void
    {
        $this->arguments['x-overflow'] = $value;
    }

    public function setDeadLetterExchange(string $value): void
    {
        $this->arguments['x-dead-letter-exchange'] = $value;
    }

    public function setDeadLetterRoutingKey(string $value): void
    {
        $this->arguments['x-dead-letter-routing-key'] = $value;
    }

    public function setSingleActiveConsumer(bool $value): void
    {
        $this->arguments['x-single-active-consumer'] = $value;
    }

    public function setMaxPriority(int $value): void
    {
        $this->arguments['x-max-priority'] = $value;
    }

    public function setQueueMode(): void
    {
        $this->arguments['x-queue-mode'];
    }
}