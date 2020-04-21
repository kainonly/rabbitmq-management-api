<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\ExchangeOption;
use RabbitMQ\API\Common\PublishOption;

class ExchangesTest extends BaseTest
{
    public function testListsExchange(): void
    {
        try {
            $response = $this->api->exchanges()->lists();
            $this->assertFalse($response->isError());
            $response = $this->api->exchanges()->lists('/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetExchange(): void
    {
        try {
            $response = $this->api->exchanges()
                ->get('amq.direct', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutExchange(): void
    {
        try {
            $option = new ExchangeOption();
            $response = $this->api->exchanges()
                ->put('dev.backup', $option, '/');
            $this->assertFalse($response->isError());
            $this->assertFalse($response->isError());
            $option = new ExchangeOption();
            $option->setType('direct');
            $option->setDurable(true);
            $option->setAutoDelete(false);
            $option->setInternal(false);
            $option->setAlternateExchange('dev.backup');
            $response = $this->api->exchanges()
                ->put('dev', $option, '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testSetBindingToExchange(): void
    {
        try {
            $option = new ExchangeOption();
            $response = $this->api->exchanges()
                ->put('dev.next', $option, '/');
            $this->assertFalse($response->isError());
            $response = $this->api->bindings()
                ->setBindingToExchange('dev', 'dev.next', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingToExchange(): void
    {
        try {
            $response = $this->api->bindings()
                ->getBindingToExchange('dev', 'dev.next', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingToExchangeFormRoutingKey(): void
    {
        try {
            $response = $this->api->bindings()
                ->getBindingToExchangeFormRoutingKey('dev', 'dev.next', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingsSource(): void
    {
        try {
            $response = $this->api->exchanges()
                ->getBindingsSource('dev', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingsDestination(): void
    {
        try {
            $response = $this->api->exchanges()
                ->getBindingsDestination('dev.next', '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteBindingToExchangeFormRoutingKey(): void
    {
        try {
            $response = $this->api->bindings()
                ->deleteBindingToExchangeFormRoutingKey('dev', 'dev.next', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPublish(): void
    {
        try {
            $option = new PublishOption();
            $option->setRoutingKey('');
            $option->setPayload('hello~');
            $option->setPayloadEncoding('string');
            $option->setProperties([]);
            $response = $this->api->exchanges()
                ->publish('dev', $option, '/');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteExchange(): void
    {
        try {
            $response = $this->api->exchanges()
                ->delete('dev', '/');
            $this->assertFalse($response->isError());
            $response = $this->api->exchanges()
                ->delete('dev.backup', '/');
            $this->assertFalse($response->isError());
            $response = $this->api->exchanges()
                ->delete('dev.next', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

}