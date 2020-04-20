<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class ConnectionsTest extends BaseTest
{
    public function testAllConnections(): void
    {
        try {
            // all
            $response = $this->api->connections()->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
            // default '/'
            $response = $this->api->connections('/')->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetConnection(): void
    {
        try {
            $response = $this->api->connections()->get('test');
            $this->assertTrue($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteConnection(): void
    {
        try {
            $response = $this->api->connections()->delete('test');
            $this->assertTrue($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetConnectionChannels(): void
    {
        try {
            $response = $this->api->connections()->getChannel('test');
            $this->assertTrue($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}