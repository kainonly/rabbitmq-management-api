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
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutPermissions(): void
    {
        try {
            $response = $this->api->permissions()->put('/', 'dev');
            var_dump($response->getMsg());
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetPermissions(): void
    {
        try {
            $response = $this->api->permissions()->get('/', 'dev');
            var_dump($response->getMsg());
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeletePermissions(): void
    {
        try {
            $response = $this->api->permissions()->delete('/', 'dev');
            var_dump($response->getMsg());
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteUser(): void
    {
        try {
            $response = $this->api->users()->delete('dev');
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}