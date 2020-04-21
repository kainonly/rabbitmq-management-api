<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class DefinitionsTest extends BaseTest
{
    public function testPutVhost(): void
    {
        try {
            $response = $this->api->vhosts()
                ->put('/dev', 'dev vhost');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetDefinitions(): void
    {
        try {
            $response = $this->api->definitions()->get('/dev');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPostDefinitions(): void
    {
        try {
            $response = $this->api->definitions()->get('/dev');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
            $definitionsData = $response->getData();
            $response = $this->api->definitions()
                ->post($definitionsData, '/dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteVhost(): void
    {
        try {
            $response = $this->api->vhosts()->delete('/dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}