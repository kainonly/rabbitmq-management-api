<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class ConsumersTest extends BaseTest
{
    public function testAllConsumers(): void
    {
        try {
            // all
            $response = $this->api->consumers()->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
            // default '/'
            $response = $this->api->consumers('/')->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}