<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\ExchangeOption;
use RabbitMQ\API\Common\MessageOption;
use RabbitMQ\API\Common\QueueOption;

class QueuesTest extends BaseTest
{
    public function testListsQueues(): void
    {
        try {
            $response = $this->api->queues()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $response = $this->api->queues()->lists('/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutQueue(): void
    {
        try {
            $option = new QueueOption($this->node);
            $option->setDurable(true);
            $option->setAutoDelete(false);
            $option->setMessageTTL(1000 * 60 * 60 * 8);
            $option->setAutoExpire(1000 * 60 * 60 * 72);
            $option->setMaxLength(3000);
            $option->setMaxLengthBytes(64 * 1024);
            $option->setDeadLetterExchange('dev');
            $option->setDeadLetterRoutingKey('dead');
            $option->setSingleActiveConsumer(true);
            $option->setOverflow([
                'reject-publish'
            ]);
            $option->setMaxPriority(1);
            $option->setQueueMasterLocator('min-masters');
            $option->setQueueLazyMode();
            $option->appendArgument('foo', 'any');
            $response = $this->api->queues()->put('dev', $option, '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetQueue(): void
    {
        try {
            $response = $this->api->queues()
                ->get('dev', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testSetBindingToQueue(): void
    {
        try {
            $option = new ExchangeOption();
            $response = $this->api->exchanges()->put('dev', $option, '/');
            $this->assertFalse($response->isError());
            $response = $this->api->bindings()
                ->setBindingToQueue('dev', 'dev', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingToQueue(): void
    {
        try {
            $response = $this->api->bindings()
                ->getBindingToQueue('dev', 'dev', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingFormRoutingKey(): void
    {
        try {
            $response = $this->api->bindings()
                ->getBindingToQueueFormRoutingKey('dev', 'dev', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindings(): void
    {
        try {
            $response = $this->api->queues()
                ->getBindings('dev', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteBindingFormRoutingKey(): void
    {
        try {
            $response = $this->api->bindings()
                ->deleteBindingToQueueFormRoutingKey('dev', 'dev', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPurgeMessage(): void
    {
        try {
            $response = $this->api->queues()
                ->purgeMessage('dev', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testAction(): void
    {
        try {
            $response = $this->api->queues()
                ->action('dev', 'sync', '/');
            $this->assertFalse($response->isError());
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
            $response = $this->api->queues()
                ->getMessage('dev', $option, '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteQueues(): void
    {
        try {
            $response = $this->api->exchanges()
                ->delete('dev', '/');
            $this->assertFalse($response->isError());
            $response = $this->api->queues()
                ->delete('dev', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}