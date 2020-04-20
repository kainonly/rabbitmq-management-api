<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class NodesTest extends BaseTest
{
    public function testNodes(): void
    {
        try {
            $response = $this->api->nodes()->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetNode(): void
    {
        try {
            $response = $this->api->nodes()->get($this->node, true, false);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}