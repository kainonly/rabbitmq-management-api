<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class OperatorPoliciesTest extends BaseTest
{
    public function testListsOperatorPolicies(): void
    {
        try {
            $response = $this->api->operatorPolicies()
                ->lists('/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testPutOperatorPolicies(): void
    {
        try {
            $response = $this->api->operatorPolicies()->put(
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

    public function testGetOperatorPolicies(): void
    {
        try {
            $response = $this->api->operatorPolicies()->get(
                'dev',
                '/'
            );
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testDeleteOperatorPolicies(): void
    {
        try {
            $response = $this->api->operatorPolicies()
                ->delete('dev', '/');
            $this->assertFalse($response->isError());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}