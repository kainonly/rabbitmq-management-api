<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

class ExchangeOption
{
    /**
     * @var string
     */
    private string $type;
    /**
     * @var bool
     */
    private bool $auto_delete;
    /**
     * @var bool
     */
    private bool $durable;
    /**
     * @var bool
     */
    private bool $internal;
    /**
     * @var array
     */
    private array $arguments = [];

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

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
     * @return bool
     */
    public function isInternal(): bool
    {
        return $this->internal;
    }

    /**
     * @param bool $internal
     */
    public function setInternal(bool $internal): void
    {
        $this->internal = $internal;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param string $value
     */
    public function setAlternateExchange(string $value): void
    {
        $this->arguments['alternate-exchange'] = $value;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return [
            'type' => $this->type,
            'auto_delete' => $this->auto_delete,
            'durable' => $this->durable,
            'internal' => $this->internal,
            'arguments' => $this->arguments
        ];
    }
}