<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

class ExchangeOption
{
    /**
     * @var string
     */
    private string $type = 'direct';
    /**
     * @var bool
     */
    private bool $auto_delete = false;
    /**
     * @var bool
     */
    private bool $durable = true;
    /**
     * @var bool
     */
    private bool $internal = false;
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
     * @param bool $auto_delete
     */
    public function setAutoDelete(bool $auto_delete): void
    {
        $this->auto_delete = $auto_delete;
    }

    /**
     * @param bool $durable
     */
    public function setDurable(bool $durable): void
    {
        $this->durable = $durable;
    }

    /**
     * @param bool $internal
     */
    public function setInternal(bool $internal): void
    {
        $this->internal = $internal;
    }

    /**
     * If messages to this exchange cannot otherwise be routed, send them to the alternate exchange named here.
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