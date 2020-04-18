<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\ExchangeOption;
use RabbitMQ\API\Common\PublishOption;

class ExchangesTest extends BaseTest
{
    public function testAll(): void
    {
        try {
            // all
            $response = $this->api->exchanges()->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
            // default '/'
            $response = $this->api->exchanges('/')->all();
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
            $response = $this->api->exchanges('/')->get('amq.direct');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPut(): void
    {
        try {
            $option = new ExchangeOption();
            $option->setType('direct');
            $option->setDurable(true);
            $option->setAutoDelete(false);
            $option->setInternal(false);
            $response = $this->api->exchanges('/')->put('test.my', $option);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingsSource(): void
    {
        try {
            $response = $this->api->exchanges('/')->getBindingsSource('test.my');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetBindingsDestination(): void
    {
        try {
            $response = $this->api->exchanges('/')->getBindingsDestination('test.my');
            $this->assertFalse($response->isError());
            var_dump($response->result());
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
            $response = $this->api->exchanges('/')->publish('test.my', $option);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDelete(): void
    {
        try {
            $response = $this->api->exchanges('/')->delete('test.my');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

}