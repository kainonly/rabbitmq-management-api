<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class PermissionsTest extends BaseTest
{
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

    public function testListsPermissions(): void
    {
        try {
            $response = $this->api->permissions()
                ->lists();
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutPermissions(): void
    {
        try {
            $response = $this->api->permissions()
                ->put('/', 'dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetPermissions(): void
    {
        try {
            $response = $this->api->permissions()
                ->get('/', 'dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeletePermissions(): void
    {
        try {
            $response = $this->api->permissions()->delete('/', 'dev');
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
}