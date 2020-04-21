<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\QueueOption;

class ParametersTest extends BaseTest
{
    public function testListParameters(): void
    {
        try {
            $response = $this->api->parameters()
                ->lists('shovel');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutParameter(): void
    {
        try {
            $option = new QueueOption();
            $option->setNode($this->node);
            $response = $this->api->queues('/')->put('dev', $option);
            $this->assertFalse($response->isError());
            $response = $this->api->queues('/')->put('dev.shovel', $option);
            $this->assertFalse($response->isError());
            $response = $this->api->parameters('/')->put(
                'shovel',
                'dev',
                [
                    'src-delete-after' => 'never',
                    'src-protocol' => 'amqp091',
                    'src-queue' => 'dev',
                    'src-uri' => 'amqp://kain:zt931003@dell:5672',
                    'ack-mode' => 'on-confirm',
                    'dest-add-forward-headers' => false,
                    'dest-protocol' => 'amqp091',
                    'dest-queue' => 'dev.shovel',
                    'dest-uri' => 'amqp://kain:zt931003@dell:5672',
                ]
            );
            var_dump($response->getMsg());
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetParameter(): void
    {
        try {
            $response = $this->api->parameters('/')->get(
                'shovel',
                'dev'
            );
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteParameter(): void
    {
        try {
            $response = $this->api->parameters('/')
                ->delete(
                    'shovel',
                    'dev'
                );
            $this->assertFalse($response->isError());

            $response = $this->api->queues('/')
                ->delete('dev');
            $this->assertFalse($response->isError());

            $response = $this->api->queues('/')
                ->delete('dev.shovel');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}