<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class PoliciesTest extends BaseTest
{
    public function testListsPolicies(): void
    {
        try {
            $response = $this->api->policies()
                ->lists('/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutPolicies(): void
    {
        try {
            $response = $this->api->policies()->put(
                'dev',
                '/',
                '^amq.',
                [
                    'max-length' => 3000,
                ]
            );
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetPolicies(): void
    {
        try {
            $response = $this->api->policies()->get(
                'dev',
                '/'
            );
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeletePolicies(): void
    {
        try {
            $response = $this->api->policies()
                ->delete('dev', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}