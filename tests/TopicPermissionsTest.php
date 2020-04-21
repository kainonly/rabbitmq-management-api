<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class TopicPermissionsTest extends BaseTest
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

    public function testPutTopicPermissions(): void
    {
        try {
            $response = $this->api->topicPermissions()->put('/', 'dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetTopicPermissions(): void
    {
        try {
            $response = $this->api->topicPermissions()->get('/', 'dev');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteTopicPermissions(): void
    {
        try {
            $response = $this->api->topicPermissions()->delete('/', 'dev');
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