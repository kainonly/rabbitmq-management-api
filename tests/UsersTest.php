<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class UsersTest extends BaseTest
{
    public function testListsUsers(): void
    {
        try {
            $response = $this->api->users()->lists(false);
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutUser(): void
    {
        try {
            $response = $this->api->users()
                ->put('dev', '123456');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetUser(): void
    {
        try {
            $response = $this->api->users()->get('dev');
            $this->assertFalse($response->isError());
            $this->assertNotEmpty($response->getData());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetPermissions(): void
    {
        try {
            $response = $this->api->users()->getPermissions('dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetTopicPermissions(): void
    {
        try {
            $response = $this->api->users()->getTopicPermissions('dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteUser(): void
    {
        try {
            $response = $this->api->users()->delete('dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testBulkDeleteUsers(): void
    {
        try {
            $response = $this->api->users()
                ->put('dev', '123456');
            $this->assertFalse($response->isError());
            $response = $this->api->users()->bulkDelete(['dev']);
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}