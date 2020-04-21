<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class ConsumersTest extends BaseTest
{
    public function testListsConsumers(): void
    {
        try {
            $response = $this->api->consumers()->lists();
            $this->assertFalse($response->isError());
            $response = $this->api->consumers()->lists('/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}