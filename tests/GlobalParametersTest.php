<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class GlobalParametersTest extends BaseTest
{
    public function testGlobalParameters(): void
    {
        try {
            $response = $this->api->globalParameters()->lists();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutGlobalParameters(): void
    {
        try {
            $response = $this->api->globalParameters()
                ->put(
                    'dev',
                    [
                        'version' => 1.0
                    ],
                );
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteGlobalParameters(): void
    {
        try {
            $response = $this->api->globalParameters()
                ->delete('dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}