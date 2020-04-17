<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

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
}