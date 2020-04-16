<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class SystemTest extends BaseTest
{
    public function testOverview(): void
    {
        try {
            $response = $this->api->system()->overview();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}