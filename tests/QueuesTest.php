<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\ExchangeOption;
use RabbitMQ\API\Common\MessageOption;
use RabbitMQ\API\Common\QueueOption;

class QueuesTest extends BaseTest
{
    public function testAll(): void
    {
        try {
            // all
            $response = $this->api->queues()->lists();
            $this->assertFalse($response->isError());
            var_dump($response->result());
            // default '/'
            $response = $this->api->queues('/')->lists();
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
            $option->setAutoExpire(1000 * 60 * 60 * 72);
            $option->setMaxLength(3000);
            $option->setMaxLengthBytes(64 * 1024);
            $option->setDeadLetterExchange('test');
            $option->setDeadLetterRoutingKey('dead');
            $option->setSingleActiveConsumer(true);
            $option->setOverflow([
                'reject-publish'
            ]);
            $option->setMaxPriority(1);
            $option->setQueueMasterLocator('min-masters');
            $option->setQueueLazyMode();
            $option->appendArgument('foo', 'any');
            $option->setNode($this->node);
            $response = $this->api->queues('/')->put('test', $option);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testSetBinding(): void
    {
        try {
            $response = $this->api->bindings('/')
                ->setBindingToQueue('test', 'test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testBinding(): void
    {
        try {
            $response = $this->api->bindings('/')->getBindingToQueue('test', 'test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingFormRoutingKey(): void
    {
        try {
            $response = $this->api->bindings('/')
                ->getBindingFormRoutingKey('test', 'test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteBindingFormRoutingKey(): void
    {
        try {
            $response = $this->api->bindings('/')
                ->deleteBindingFormRoutingKey('test', 'test', '~');
            var_dump($response->getMsg());
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindings(): void
    {
        try {
            $response = $this->api->queues('/')->getBindings('test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPurgeMessage(): void
    {
        try {
            $response = $this->api->queues('/')->purgeMessage('test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testAction(): void
    {
        try {
            $response = $this->api->queues('/')->setAction('test', 'sync');
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
            $option = new QueueOption();
            $option->setNode($this->node);
            $response = $this->api->queues('/')->put('test.tmp', $option);
            $this->assertFalse($response->isError());
            $response = $this->api->queues('/')->delete('test.tmp');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}