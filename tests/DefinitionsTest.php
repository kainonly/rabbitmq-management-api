<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class DefinitionsTest extends BaseTest
{
    public function testGetDefinitions(): void
    {
        try {
            $response = $this->api->definitions('/test')->get();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPostDefinitions(): void
    {
        try {
            $response = $this->api->definitions('/test')->get();
            $this->assertFalse($response->isError());
            $definitionsData = $response->getData();
            $response = $this->api->definitions('/test')->post($definitionsData);
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}