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
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetWhoami(): void
    {
        try {
            $response = $this->api->getWhoami();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testAlivenessTest(): void
    {
        try {
            $response = $this->api->alivenessTest('/');
            $this->assertFalse($response->isError());
            $this->assertSame($response->getData()['status'], 'ok');
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testHealthchecks(): void
    {
        try {
            $response = $this->api->healthchecks($this->node);
            $this->assertFalse($response->isError());
            $this->assertSame($response->getData()['status'], 'ok');
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testAuth(): void
    {
        try {
            $response = $this->api->auth();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testRebalanceQueues(): void
    {
        try {
            $response = $this->api->rebalanceQueues();
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}