<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class ClusterNameTest extends BaseTest
{
    public function testGetClusterName(): void
    {
        try {
            $response = $this->api->clusterName()->get();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $this->assertSame($response->getData()['name'], $this->cluster);
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutClusterName(): void
    {
        try {
            $response = $this->api->clusterName()
                ->put($this->cluster);
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}