<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class VhostsTest extends BaseTest
{

    public function testVhosts(): void
    {
        try {
            $response = $this->api->vhosts()->lists();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutVhost(): void
    {
        try {
            $response = $this->api->vhosts()
                ->put('/dev', 'dev vhost');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetVhost(): void
    {
        try {
            $response = $this->api->vhosts()->get('/dev');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetPermissions(): void
    {
        try {
            $response = $this->api->vhosts()->getPermissions('/dev');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetTopicPermissions(): void
    {
        try {
            $response = $this->api->vhosts()->getTopicPermissions('/dev');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testStart(): void
    {
        try {
            $response = $this->api->vhosts()->start('/dev', $this->node);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteVhost(): void
    {
        try {
            $response = $this->api->vhosts()->delete('/dev');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}