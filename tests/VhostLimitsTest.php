<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class VhostLimitsTest extends BaseTest
{
    public function testListsVhostLimits(): void
    {
        try {
            $response = $this->api->vhostLimits()->lists();
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutVhostLimit(): void
    {
        try {
            $response = $this->api->vhostLimits()
                ->put('/', 'max-connections', 100);
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteVhost(): void
    {
        try {
            $response = $this->api->vhostLimits()
                ->delete('/', 'max-connections');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}