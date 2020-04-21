<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;
use RabbitMQ\API\RabbitMQ;

class MainTest extends BaseTest
{
    public function testOverview(): void
    {
        try {
            $client = RabbitMQ::create(
                $this->uri,
                $this->user,
                '123456'
            );
            $response = $client->overview();
            $this->assertTrue($response->isError());
            $this->assertSame($response->result(), [
                'error' => (int)$response->isError(),
                'msg' => $response->getMsg(),
            ]);
            $this->assertNotEmpty($response->getMsg());
            $response = $this->api->overview();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $this->assertSame($response->getMsg(), 'ok');
            $this->assertSame($response->result(), [
                'error' => (int)$response->isError(),
                'msg' => $response->getMsg(),
                'data' => $response->getData()
            ]);
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testExtensions(): void
    {
        try {
            $response = $this->api->extensions();
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testWhoami(): void
    {
        try {
            $response = $this->api->whoami();
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