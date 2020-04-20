<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class BindingsTest extends BaseTest
{
    public function testAll(): void
    {
        try {
            // all
            $response = $this->api->bindings()->lists();
            $this->assertFalse($response->isError());
            var_dump($response->result());
            // default '/'
            $response = $this->api->bindings('/')->lists();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}