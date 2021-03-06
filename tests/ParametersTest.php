<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\QueueOption;

class ParametersTest extends BaseTest
{
    public function testListsParameters(): void
    {
        try {
            $response = $this->api->parameters()
                ->lists('shovel');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

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

    public function testGetParameter(): void
    {
        try {
            $response = $this->api->parameters()->get(
                'shovel',
                '/',
                'dev'
            );
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteParameter(): void
    {
        try {
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