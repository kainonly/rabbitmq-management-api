<?php
declare(strict_types=1);

namespace RabbitMQAPITests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use RabbitMQ\API\RabbitMQ;

abstract class BaseTest extends TestCase
{
    protected string $cluster;
    protected string $node;
    protected RabbitMQ $api;

    public function setUp(): void
    {
        $this->cluster = getenv('cluster');
        $this->node = getenv('node');
        $client = new Client([
            'base_uri' => getenv('uri'),
            'auth' => [getenv('user'), getenv('pass')],
            'timeout' => 30.0,
            'debug' => false,
            'verify' => false,
            'version' => 2.0
        ]);
        $this->api = new RabbitMQ($client);
    }
}