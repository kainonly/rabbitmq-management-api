<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\Common\ExchangeOption;

class ExchangesTest extends BaseTest
{
    public function testAllExchanges(): void
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

    public function testGetExchange(): void
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

    public function testPutExchange(): void
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

    public function testDeleteExchange(): void
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