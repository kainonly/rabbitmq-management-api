<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\QueueOption;

class ChannelsTest extends BaseTest
{
    public function testPutParameter(): void
    {
        try {
            $option = new QueueOption($this->node);
            $response = $this->api->queues()->put('dev', $option, '/');
            $this->assertFalse($response->isError());
            $response = $this->api->queues()->put('dev.shovel', $option, '/');
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

    public function testListsChannels(): void
    {
        try {
            sleep(10);
            $response = $this->api->channels()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $response = $this->api->channels()->lists('/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetChannel(): void
    {
        try {
            $response = $this->api->connections()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $data = array_filter(
                $response->getData(),
                fn($v) => $v['client_properties']['connection_name'] === 'Shovel dev'
            )[0];
            $response = $this->api->channels()->get($data['name']);
            $this->assertTrue($response->isError());
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