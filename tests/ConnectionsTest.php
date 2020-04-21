<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\QueueOption;

class ConnectionsTest extends BaseTest
{
    public function testPutParameter(): void
    {
        try {
            $option = new QueueOption($this->node);
            $response = $this->api->queues()
                ->put('dev', $option, '/');
            $this->assertFalse($response->isError());
            $response = $this->api->queues()
                ->put('dev.shovel', $option, '/');
            $this->assertFalse($response->isError());
            $response = $this->api->parameters()->put(
                'shovel',
                'dev',
                '/',
                [
                    'src-delete-after' => 'never',
                    'src-protocol' => 'amqp091',
                    'src-queue' => 'dev',
                    'src-uri' => $this->amqp,
                    'ack-mode' => 'on-confirm',
                    'dest-add-forward-headers' => false,
                    'dest-protocol' => 'amqp091',
                    'dest-queue' => 'dev.shovel',
                    'dest-uri' => $this->amqp,
                ]
            );
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testListsConnections(): void
    {
        try {
            sleep(10);
            $response = $this->api->connections()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $response = $this->api->connections()->lists('/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetConnection(): void
    {
        try {
            $response = $this->api->connections()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $data = array_filter(
                $response->getData(),
                fn($v) => $v['client_properties']['connection_name'] === 'Shovel dev'
            )[0];
            $response = $this->api->connections()->get($data['name']);
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetConnectionChannels(): void
    {
        try {
            $response = $this->api->connections()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $data = array_filter(
                $response->getData(),
                fn($v) => $v['client_properties']['connection_name'] === 'Shovel dev'
            )[0];
            $response = $this->api->connections()->getChannels($data['name']);
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteConnection(): void
    {
        try {
            $response = $this->api->connections()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $data = array_filter(
                $response->getData(),
                fn($v) => $v['client_properties']['connection_name'] === 'Shovel dev'
            )[0];
            $response = $this->api->connections()->delete($data['name']);
            $this->assertFalse($response->isError());
            $response = $this->api->parameters()
                ->delete(
                    'shovel',
                    '/',
                    'dev'
                );
            $this->assertFalse($response->isError());
            $response = $this->api->queues()
                ->delete('dev', '/');
            $this->assertFalse($response->isError());
            $response = $this->api->queues()
                ->delete('dev.shovel', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}