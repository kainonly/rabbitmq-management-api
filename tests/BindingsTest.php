<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class BindingsTest extends BaseTest
{
    public function testListsBindings(): void
    {
        try {
            $response = $this->api->bindings()->lists();
            $this->assertFalse($response->isError());
            $response = $this->api->bindings()->lists('/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}