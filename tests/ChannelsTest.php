<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use Exception;

class ChannelsTest extends BaseTest
{
    public function testAllChannels(): void
    {
        try {
            // all
            $response = $this->api->channels()->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
            // default '/'
            $response = $this->api->channels('/')->all();
            $this->assertFalse($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }

    public function testGetChannel(): void
    {
        try {
            $response = $this->api->channels()->get('test');
            $this->assertTrue($response->isError());
            var_dump($response->result());
        } catch (Exception $e) {
            $this->expectErrorMessage($e->getMessage());
        }
    }
}