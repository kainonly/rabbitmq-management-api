<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class GlobalParametersTest extends BaseTest
{
    public function testGlobalParameters(): void
    {
        try {
            // all
            $response = $this->api->globalParameters()->lists();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutGlobalParameters(): void
    {
        try {
            $response = $this->api->globalParameters()->put(
                'test',
                [
                    'version' => 1.0
                ],
            );
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteGlobalParameters(): void
    {
        try {
            $response = $this->api->globalParameters()->delete('test');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}