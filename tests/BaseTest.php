<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use PHPUnit\Framework\TestCase;
use RabbitMQ\API\RabbitMQ;

abstract class BaseTest extends TestCase
{
    protected RabbitMQ $api;

    public function setUp(): void
    {
        try {
            $this->api = RabbitMQ::create(
                getenv('uri'),
                getenv('user'),
                getenv('pass')
            );
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}