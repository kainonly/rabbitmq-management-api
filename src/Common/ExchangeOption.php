<?php

namespace RabbitMQ\API\Common;

class ExchangeOption
{
    private string $type;
    private bool $auto_delete;
    private bool $durable;
    private bool $internal;
    private array $arguments = [];
}