<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class MainTest extends BaseTest
{
    public function testGetOverview(): void
    {
        try {
            $response = $this->api->getOverview();
            $this->assertFalse($response->isError());
            $this->assertSame($response->getMsg(), 'ok');
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetClusterName(): void
    {
        try {
            $response = $this->api->getClusterName();
            $this->assertFalse($response->isError());
            $this->assertSame($response->getData()['name'], $this->cluster);
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutClusterName(): void
    {
        try {
            $response = $this->api->putClusterName($this->cluster);
            var_dump($response->getMsg());
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetExtensions(): void
    {
        try {
            $response = $this->api->getExtensions();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}