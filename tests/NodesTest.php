<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class NodesTest extends BaseTest
{
    public function testListsNodes(): void
    {
        try {
            $response = $this->api->nodes()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetNode(): void
    {
        try {
            $response = $this->api->nodes()
                ->get($this->node, true, false);
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}