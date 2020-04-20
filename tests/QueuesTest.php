<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\MessageOption;
use RabbitMQ\API\Common\QueueOption;

class QueuesTest extends BaseTest
{
    public function testAll(): void
    {
        try {
            // all
            $response = $this->api->queues()->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
            // default '/'
            $response = $this->api->queues('/')->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGet(): void
    {
        try {
            // all
            $response = $this->api->queues('/')->get('test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPut(): void
    {
        try {
            $option = new QueueOption();
            $option->setDurable(true);
            $option->setAutoDelete(false);
            $option->setMessageTTL(1000 * 60 * 60 * 8);
            $option->setSingleActiveConsumer(true);
            $option->setOverflow([
                'reject-publish'
            ]);
            $option->setMaxPriority(1);
            $option->setQueueMasterLocator('min-masters');
            $option->setQueueLazyMode();
            $option->setNode($this->node);
            $response = $this->api->queues('/')->put('test', $option);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testBindings(): void
    {
        try {
            $response = $this->api->queues('/')->bindings('test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPurge(): void
    {
        try {
            $response = $this->api->queues('/')->purge('test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testAction(): void
    {
        try {
            $response = $this->api->queues('/')->actions('test', 'sync');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetMessage(): void
    {
        try {
            $option = new MessageOption();
            $option->setCount(10);
            $option->setAck(true);
            $option->setAutoEncoding(true);
            $option->setTruncate(64 * 1024);
            $response = $this->api->queues('/')->getMessage('test', $option);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }


    public function testDelete(): void
    {
        try {
            $response = $this->api->queues('/')->delete('test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

}