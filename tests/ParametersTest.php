<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class ParametersTest extends BaseTest
{
    public function testAll(): void
    {
        try {
            // all
            $response = $this->api->parameters('/test')->lists(null);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutParameter(): void
    {
        try {
            $response = $this->api->parameters('/test')->put(
                'mycycle',
                'size',
                '64'
            );
            $this->assertTrue($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteParameter(): void
    {
        try {
            $response = $this->api->parameters('/test')->delete(
                'mycycle',
                'size'
            );
            $this->assertTrue($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}